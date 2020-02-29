  @extends('layouts.shop')
    @section('title', '购物车列表')
    @section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">2</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     
     
     @foreach($info as $v)
     <div class="dingdanlist">
      <table>
       <tr>
        <td width="4%"><input type="checkbox" name="1" /></td>
        <td class="dingimg" width="15%"><img src="{{env('UPLOAD_URL')}}{{$v->g_img}}" /></td>
        <td width="50%">
         <h3>{{$v->g_name}}</h3>
         <time>下单时间：{{$v->add_time}}</time>
        </td>
        <td align="right"><input type="text" class="spinnerExample" /></td>
       </tr>
       <tr>
        <th colspan="4"><strong class="orange">¥{{$v->g_price}}</strong></th>
       </tr>
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" /> 删除</a></td>
       </tr>
      </table>
     </div><!--dingdanlist/-->
     @endforeach
     @endsection
     
     
     