<style type="text/css">
    .demo{width:760px; margin:20px auto 0 auto; height:70px;}
    .button {
        display: inline-block;
        outline: none;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        font: 16px/100% 'Microsoft yahei',Arial, Helvetica, sans-serif;
        padding: .5em 2em .55em;
        text-shadow: 0 1px 1px rgba(0,0,0,.3);
        -webkit-border-radius: .5em;
        -moz-border-radius: .5em;
        border-radius: .5em;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.2);
        -moz-box-shadow: 0 1px 2px rgba(0,0,0,.2);
        box-shadow: 0 1px 2px rgba(0,0,0,.2);
    }
    .button:hover {
        text-decoration: none;
    }
    .button:active {
        position: relative;
        top: 1px;
    }
    .bigrounded {
        -webkit-border-radius: 2em;
        -moz-border-radius: 2em;
        border-radius: 2em;
    }
    .medium {
        font-size: 12px;
        padding: .4em 1.5em .42em;
    }
    .small {
        font-size: 11px;
        padding: .2em 1em .275em;
    }


    /* blue */
    .blue {
        color: #d9eef7;
        border: solid 1px #0076a3;
        background: #0095cd;
        background: -webkit-gradient(linear, left top, left bottom, from(#00adee), to(#0078a5));
        background: -moz-linear-gradient(top,  #00adee,  #0078a5);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#00adee', endColorstr='#0078a5');
    }
    .blue:hover {
        background: #007ead;
        background: -webkit-gradient(linear, left top, left bottom, from(#0095cc), to(#00678e));
        background: -moz-linear-gradient(top,  #0095cc,  #00678e);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#0095cc', endColorstr='#00678e');
    }
    .blue:active {
        color: #80bed6;
        background: -webkit-gradient(linear, left top, left bottom, from(#0078a5), to(#00adee));
        background: -moz-linear-gradient(top,  #0078a5,  #00adee);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#0078a5', endColorstr='#00adee');
    }

    /* green */
    .green {
        color: #e8f0de;
        border: solid 1px #538312;
        background: #64991e;
        background: -webkit-gradient(linear, left top, left bottom, from(#7db72f), to(#4e7d0e));
        background: -moz-linear-gradient(top,  #7db72f,  #4e7d0e);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#7db72f', endColorstr='#4e7d0e');
    }
    .green:hover {
        background: #538018;
        background: -webkit-gradient(linear, left top, left bottom, from(#6b9d28), to(#436b0c));
        background: -moz-linear-gradient(top,  #6b9d28,  #436b0c);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#6b9d28', endColorstr='#436b0c');
    }
    .green:active {
        color: #a9c08c;
        background: -webkit-gradient(linear, left top, left bottom, from(#4e7d0e), to(#7db72f));
        background: -moz-linear-gradient(top,  #4e7d0e,  #7db72f);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#4e7d0e', endColorstr='#7db72f');
    }

    /* white */
    .white {
        color: #606060;
        border: solid 1px #b7b7b7;
        background: #fff;
        background: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#ededed));
        background: -moz-linear-gradient(top,  #fff,  #ededed);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#ededed');
    }
    .white:hover {
        background: #ededed;
        background: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#dcdcdc));
        background: -moz-linear-gradient(top,  #fff,  #dcdcdc);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#dcdcdc');
    }
    .white:active {
        color: #999;
        background: -webkit-gradient(linear, left top, left bottom, from(#ededed), to(#fff));
        background: -moz-linear-gradient(top,  #ededed,  #fff);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#ffffff');
    }

    /* orange */
    .orange {
        color: #fef4e9;
        border: solid 1px #da7c0c;
        background: #f78d1d;
        background: -webkit-gradient(linear, left top, left bottom, from(#faa51a), to(#f47a20));
        background: -moz-linear-gradient(top,  #faa51a,  #f47a20);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#faa51a', endColorstr='#f47a20');
    }
    .orange:hover {
        background: #f47c20;
        background: -webkit-gradient(linear, left top, left bottom, from(#f88e11), to(#f06015));
        background: -moz-linear-gradient(top,  #f88e11,  #f06015);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#f88e11', endColorstr='#f06015');
    }
    .orange:active {
        color: #fcd3a5;
        background: -webkit-gradient(linear, left top, left bottom, from(#f47a20), to(#faa51a));
        background: -moz-linear-gradient(top,  #f47a20,  #faa51a);
        filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#f47a20', endColorstr='#faa51a');
    }

</style>
<!DOCTYPE HTML>
<html>
<head>
    <title> 收益表格 </title>
    <meta charset="utf-8">
    <meta name="Generator" content="EditPlus">
    <meta name="Author" content="tschengbin">
    <meta name="Keywords" content="jquery tableSort">
    <meta name="Description" content="">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <style type="text/css">
        p{
            width: 1024px;
            margin: 0 auto;/*p相对屏幕左右居中*/
        }
        table{
            border: solid 1px #666;
            border-collapse: collapse;
            width: 100%;
            cursor: default;
        }
        tr{
            border: solid 1px #666;
            height: 30px;
        }
        table thead tr{
            background-color: #ccc;
        }
        td{
            border: solid 1px #666;
        }
        th{
            border: solid 1px #666;
            text-align: center;
            cursor: pointer;
        }
        .sequence{
            text-align: center;
        }
        .hover{
            background-color: #3399FF;
        }
    </style>
</head>
<body>
<p>
<table id="tableSort">
    <thead>
    <tr>
        <th type="string">月份</th>
        <th type="number">收益总额</th>
    </tr>
    </thead>
    <tbody>
    <tr class="hover">
        <?php
        include '../common/config.php';
        include '../common/DBConnector.php';
        include 'admin_functions.php';
        $admin = new admin_functions();
        $data = $admin->show_revenue_by_month($admin->list_data());

        foreach ($data as $key => $value) {
            echo "<td>$key</td>";
            echo "<td>$value</td>";
            echo "</tr>";
        }

        ?>
    </tr>
    </tbody>
</table>
<p>
    <div class="demo">
    <a href="home.php" class="button blue bigrounded" >返回</a>
</div>
</p>
<script type="text/javascript">
    $(document).ready(function(){
        var tableObject = $('#tableSort');//获取id为tableSort的table对象
        var tbHead = tableObject.children('thead');//获取table对象下的thead
        var tbHeadTh = tbHead.find('tr th');//获取thead下的tr下的th
        var tbBody = tableObject.children('tbody');//获取table对象下的tbody
        var tbBodyTr = tbBody.find('tr');//获取tbody下的tr
        var sortIndex = -1; //初始化索引
        tbHeadTh.each(function() {//遍历thead的tr下的th
            var thisIndex = tbHeadTh.index($(this));//获取th所在的列号
            //鼠标移除和聚焦的效果，不重要
            $(this).mouseover(function(){ //鼠标移开事件
                tbBodyTr.each(function(){//编列tbody下的tr
                    var tds = $(this).find("td");//获取列号为参数index的td对象集合
                    $(tds[thisIndex]).addClass("hover");
                });
            }).mouseout(function(){ //鼠标聚焦时间
                tbBodyTr.each(function(){
                    var tds = $(this).find("td");
                    $(tds[thisIndex]).removeClass("hover");
                });
            });

            $(this).click(function() {  //鼠标点击事件
                var dataType = $(this).attr("type"); //获取当前点击列的 type
                checkColumnValue(thisIndex, dataType); //对当前点击的列进行排序 （当前索引，排序类型）
            });
        });

        //显示效果，不重要
        $("tbody tr").removeClass();//先移除tbody下tr的所有css类
        $("tbody tr").mouseover(function(){
            $(this).addClass("hover");
        }).mouseout(function(){
            $(this).removeClass("hover");
        });

        //对表格排序
        function checkColumnValue(index, type) {
            var trsValue = new Array();  //创建一个新的列表
            tbBodyTr.each(function() { //遍历所有的tr标签
                var tds = $(this).find('td');//查找所有的 td 标签
                //将当前的点击列 push 到一个新的列表中
                //包括 当前行的 类型、当前索引的 值，和当前行的值
                trsValue.push(type + ".separator" + $(tds[index]).html() + ".separator" + $(this).html());
                $(this).html("");//清空当前列
            });
            var len = trsValue.length;//获取所有要拍戏的列的长度
            if(index == sortIndex){//sortIndex =-1
                trsValue.reverse();//???
            } else {
                for(var i = 0; i < len; i++){//遍历所有的行
                    type = trsValue[i].split(".separator")[0];// 获取要排序的类型
                    for(var j = i + 1; j < len; j++){
                        value1 = trsValue[i].split(".separator")[1];//当前值
                        value2 = trsValue[j].split(".separator")[1];//当前值的下一个
                        if(type == "number"){
                            //js 三元运算  如果 values1 等于 '' （空） 那么，该值就为0，否则 改值为当前值
                            value1 = value1 == "" ? 0 : value1;
                            value2 = value2 == "" ? 0 : value2;
                            //parseFloat() 函数可解析一个字符串，并返回一个浮点数。
                            //该函数指定字符串中的首个字符是否是数字。如果是，则对字符串进行解析，直到到达数字的末端为止，然后以数字返回该数字，而不是作为字符串。
                            //如果字符串的第一个字符不能被转换为数字，那么 parseFloat() 会返回 NaN。
                            if(parseFloat(value1) > parseFloat(value2)){//如果当前值 大于 下一个值
                                var temp = trsValue[j];//那么就记住 大 的那个值
                                trsValue[j] = trsValue[i];
                                trsValue[i] = temp;
                            }
                        } else if(type == "ip"){
                            if(ip2int(value1) > ip2int(value2)){
                                var temp = trsValue[j];
                                trsValue[j] = trsValue[i];
                                trsValue[i] = temp;
                            }
                        } else {
                            //JavaScript localeCompare() 方法 用本地特定的顺序来比较两个字符串。
                            //说明比较结果的数字。
                            // 如果 stringObject 小于 target，则 localeCompare() 返回小于 0 的数。
                            // 如果 stringObject 大于 target，则该方法返回大于 0 的数。
                            // 如果两个字符串相等，或根据本地排序规则没有区别，该方法返回 0。
                            if (value1.localeCompare(value2) > 0) {//该方法不兼容谷歌浏览器
                                var temp = trsValue[j];
                                trsValue[j] = trsValue[i];
                                trsValue[i] = temp;
                            }
                        }
                    }
                }
            }
            for(var i = 0; i < len; i++){
                //将排序完的 值 插入到 表格中
                //:eq(index) 匹配一个给定索引值的元素
                $("tbody tr:eq(" + i + ")").html(trsValue[i].split(".separator")[2]);
                //console.log($("tbody tr:eq(" + i + ")").html())
            }
            sortIndex = index;
        }
        //IP转成整型 ？？？？？
        function ip2int(ip){
            var num = 0;
            ip = ip.split(".");
            //Number() 函数把对象的值转换为数字。
            num = Number(ip[0]) * 256 * 256 * 256 + Number(ip[1]) * 256 * 256 + Number(ip[2]) * 256 + Number(ip[3]);
            return num;
        }
    })
</script>
</body>
</html>