<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"D:\www\thinkphp\public/../application/home/view/default/index\vactivity.html";i:1512025680;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>小区活动</title>

    <!-- Bootstrap -->
    <link href="/static/statics/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/statics/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .main{margin-bottom: 60px;}
        .indexLabel{padding: 10px 0; margin: 10px 0 0; color: #fff;}
    </style>
</head>
<body>
<div class="main">
    <!--导航部分-->
    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid text-center">
            <div class="col-xs-3">
                <p class="navbar-text"><a href="/home/index/index.html" class="navbar-link">首页</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="/home/index/fuwu.html" class="navbar-link">服务</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="/home/index/faxian.html" class="navbar-link">发现</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a  id="my" href="javascript:;" class="navbar-link">我的</a></p>
            </div>
        </div>
    </nav>
    <!--导航结束-->

    <div class="container-fluid">
        <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Vactivity): $mod = ($i % 2 );++$i;?>
        <div class="row noticeList">
            <a href="<?php echo url('vactivityDetail?id='.$Vactivity['id']); ?>">
                <div class="col-xs-2">
                    <img class="noticeImg" src="<?php echo get_cover($Vactivity['cover_id'])['path']; ?>" />
                </div>
                <div class="col-xs-10">
                    <p class="title"><?php echo $Vactivity['title']; ?></p>
                    <p class="intro"><?php echo $Vactivity['description']; ?></p>
                    <p class="info">浏览次数:<?php echo $Vactivity['view']; ?><span class="pull-right"><?php echo time_format($Vactivity['create_time'] ); ?></span> </p>
                </div>
            </a>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        <div class="ajax"></div>
    </div>
    <button class="btn btn-info" id="get">获取更多</button>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/static/static/jquery-1.11.2.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/static/statics/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(function () {
            function getLocalTime(time) {
                return new Date(parseInt(time) * 1000).toLocaleString().replace(/\//g, "-").replace(/日/g, " ").replace(/上午|下午/g, " ");
            }
            var page=1;
            $("#get").click(function(){
                ++page;
                $.getJSON("/home/index/vactivityAjax.html",{page:page},function(data){
                    if(data==""){
                        $("button").html('没有更多了!')
                    }
                    $.each(data,function(){
                        var that = this;
                        var cover_id=this.cover_id;
                        $.getJSON("/home/index/getPicture.html",{cover_id:cover_id},function(src){
                            $(".ajax").append("<div class='row noticeList'><a href='/home/index/vactivityDetail?id="+that.id+"'><div class='col-xs-2'><img class='noticeImg' src='"+src.path+"' /></div><div class='col-xs-10'><p class='title'>"+that.title+"</p><p class='intro'>"+that.title+that.title+"</p><p class='info'>浏览次数:"+that.view+"<span class='pull-right'>"+getLocalTime(that.create_time)+"</span></p></div></a></div>");
                        });

                    });
                })
            })
        });
</script>
<script>
    $(function(){
        $("#my").click(function(){
            var login ="<?=is_login()?>";
            if(login){

                window.location="/user/user/my.html";
            }else{
                alert("请先登录");
                window.location="/user/login/index.html";
            }
        });

    })
</script>
</body>
</html>