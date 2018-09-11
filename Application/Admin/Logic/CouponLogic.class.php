<?php
/**
 * 优惠券逻辑层
 * Created by PhpStorm.
 * User: wzj
 * Date: 2018/4/16
 * Time: 15:32
 */

namespace Admin\Logic;

class CouponLogic{

    /**
     * 发放优惠券
     * @author wzj
     * @param $user_ids
     * @param $coupon_id
     * @return array
     * 2018/4/16
     */
    public function sendCoupon($user_ids, $coupon_id)
    {
        $user_ids = rtrim($user_ids,',');
        $arr_ids = explode(',',$user_ids);

        //判断优惠券
        $coupon_data = M('api_coupon')->where(['id'=>$coupon_id])->find();
        if (empty($coupon_data)){
            return [
              'type'=>0,
              'msg' =>'优惠券不存在'
            ];
        }

        if ($coupon_data['status'] == 0){
            return [
                'type'=>0,
                'msg' =>'优惠券处于禁用状态'
            ];
        }

        if ($coupon_data['time_type'] ==0){
            if (time() < $coupon_data['use_start_time']){
                return [
                    'type'=>0,
                    'msg' =>'优惠券未到使用时间'
                ];
            }

            if (time() > $coupon_data['use_end_time']){
                return [
                    'type'=>0,
                    'msg' =>'优惠券已过期'
                ];
            }
        }


        //判断优惠券限制数量
        if ($coupon_data['createnum'] != 0){
            $send_count = M('api_coupon_user')->where(['coupon_id'=>$coupon_id])->count();
            if ($coupon_data['createnum']-$coupon_data['send_num']<=0){
                return [
                    'type'=>0,
                    'msg' =>'优惠券已发放完'
                ];
            }

            $unsend_count = $coupon_data['createnum'] - $send_count;  //剩余优惠券数量
            if (count($arr_ids) > $unsend_count){
                return [
                    'type'=>0,
                    'msg' =>'优惠券不足'
                ];
            }

        }

        $send_data = [];
        foreach($arr_ids as $k=>$v){
            $send_data[] = [
                'cu_id' => getCode($v).rand(10,99), //券号
                'user_id' => $v,
                'coupon_id' => $coupon_id,
                'create_time'=> time()
            ];
        }

        M()->startTrans();
        $res = M('api_coupon_user')->addAll($send_data);  //发送优惠券
        $res_2 = M('api_coupon')->where(['id'=>$coupon_id])->setInc('send_num',count($arr_ids)); //更新落户数量
        if ($res && $res_2){
            M()->commit();
            return [
                'type'=>1,
                'msg' =>'发送成功'
            ];
        } else {
            M()->rollback();
            return [
                'type'=>0,
                'msg' =>'发送失败'
            ];
        }

    }

}