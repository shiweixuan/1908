<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Index\ShopLogin;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

//发送邮件
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;
class LoginController extends Controller
{
    public function reg_do(){
        $data=request()->except('_token');
        
        //判断验证码
        $code=session('code');
        if($code!=$data['code']){
            return redirect('/register')->with('msg','您输入的验证码不对');
        }

        //密码和确认密码是否一致
        if($data['u_pwd']!=$data['repwd']){
            return redirect('/register')->with('msg','两次密码不一致');
        }

        //入库
        $user=[
            'moblie'=>$data['moblie'],
            'u_pwd'=>encrypt($data['u_pwd']),
            'add_time'=>time(),
        ];
        $res=ShopLogin::create($user);

        if($res){
            return redirect('/login');
        }
    }


    public function logindo(Request $request)
    {
        $data=request()->except('_token');


        $where=[
            ['moblie','=',$data['moblie']],
        ];
        $res=ShopLogin::where($where)->first();
        if($data['u_pwd']!=decrypt($res['u_pwd'])){
            return redirect('/login')->with('msg','没有此用户或密码错误');
        }
            session(['userInfo'=>$res]);
            request()->session()->save();
            return redirect('/');
    }

    //发送邮件
    public function sendEmail(){
        $email='y18942605941@163.com';
         Mail::to($email)->send(new sendCode());
    }

      public function ajaxsend(){
        //接受注册页面的手机号
        // $moblie = '13722340507';
        $moblie = request()->moblie;
        // dd($moblie);
        $code = rand(1000,9999);
        $res = $this->sendSms($moblie,$code);
        // print_r($res);exit;
        if( $res['Code']=='OK'){
            session(['code'=>$code]);
            request()->session()->save();

            echo json_encode(['code'=>'00000','msg'=>'ok']);die;
        }
        echo json_encode(['code'=>'00001','msg'=>'短信发送失败']);die;

    }
     public function sendSms($moblie,$code){

        AlibabaCloud::accessKeyClient('LTAI4FcVLNHMze8EK85NqBvS','EYRkwlyMU52CFImc5kLogewIq2owCO')
                                    ->regionId('cn-hangzhou')
                                    ->asDefaultClient();

            try {
                $result = AlibabaCloud::rpc()
                                      ->product('Dysmsapi')
                                      // ->scheme('https') // https | http
                                      ->version('2017-05-25')
                                      ->action('SendSms')
                                      ->method('POST')
                                      ->host('dysmsapi.aliyuncs.com')
                                      ->options([
                                                    'query' => [
                                                      'RegionId' => "cn-hangzhou",
                                                      'PhoneNumbers' => $moblie,
                                                      'SignName' => "小不点",
                                                      'TemplateCode' => "SMS_181210736",
                                                      'TemplateParam' => "{code:$code}",
                                                    ],
                                                ])
                                      ->request();
                return $result->toArray();
            } catch (ClientException $e) {
                return $e->getErrorMessage();
            } catch (ServerException $e) {
                return $e->getErrorMessage();
            }
    }

}
