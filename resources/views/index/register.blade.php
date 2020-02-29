    @extends('layouts.shop')
    @section('title', '注册页面')
    @section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('login/reg_do')}}" method="post" class="reg-login">
        @csrf
      <h3>已经有账号了？点此<a class="orange" href="login.html">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" placeholder="输入手机号码或者邮箱号" name="moblie"/></div>
       <div class="lrList2"><input type="text" placeholder="输入短信验证码" name="code"/> <button type="button">获取验证码</button></div>
       <div class="lrList"><input type="password" placeholder="设置新密码（6-18位数字或字母）" name="u_pwd"/></div>
       <div class="lrList"><input type="password" placeholder="再次输入密码" name="repwd"/></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->
     <script>
        $('button').click(function(){
          var moblie=$('input[name="moblie"]').val();
          if(!moblie){
            alert('请输入手机号码或邮箱号');
            return;
          }

          $.get('/send',{moblie:moblie},function(result){
            if(result.code=='00000'){
              alert('发送成功');
            }
          },'json')
        });
     </script>
    @endsection
