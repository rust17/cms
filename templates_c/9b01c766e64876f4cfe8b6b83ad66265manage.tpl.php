<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>main</title>
    <link rel="stylesheet" type="text/css" href="../style/admin.css">
</head>
<body id="main">
    <div class="map">
        管理首页 &gt;&gt; 管理员管理 <strong>&gt;&gt; <?php echo $this->_vars['title'];?></strong>
    </div>
<?php if($this->_vars['list']){ ?>
    <table cellpadding="0">
        <tr><th>编号</th><th>用户名</th><th>等级</th><th>登录次数</th><th>最近登录ip</th><th>最近登录时间</th><th>操作</th></tr>
        <?php foreach ($this->_vars['AllManage'] as $key=>$value){ ?>
            <tr>
                <td><?php echo $value->id ?></td>
                <td><?php echo $value->admin_user ?></td>
                <td><?php echo $value->level ?></td>
                <td><?php echo $value->login_count ?></td>
                <td><?php echo $value->last_ip ?></td>
                <td><?php echo $value->last_time ?></td>
                <td><a href="manage.php?action=update&id=<?php echo $value->id ?>">修改</a> | <a href="manage.php?action=delete&id=<?php echo $value->id ?>">删除</a></td>
            </tr>
        <?php } ?>
    </table>
    <p class="center">[ <a href="manage.php?action=add">新增管理员</a> ]</p>
<?php } ?>
<?php if($this->_vars['add']){ ?>
    <form method="post">
        <table class="left">
            <tr><td>用户名: <input type="text" name="admin_user" class="text"/></td></tr>
            <tr><td>密&nbsp码: <input type="password" name="admin_pass" class="text"/></td></tr>
            <tr><td>等&nbsp级: <select name="level">
                        <option value="1">后台游客</option>
                        <option value="2">会员专员</option>
                        <option value="3">评论专员</option>
                        <option value="4">发帖专员</option>
                        <option value="5">普通管理员</option>
                        <option value="6">超级管理员</option>
                    </select></td></tr>
        <tr><td><input type="submit" name="send" value="新增管理员" class="send"/>[ <a href="manage.php?action=list">返回列表</a> ]</td></tr>
        </table>
    </form>
<?php } ?>

</body>
</html>