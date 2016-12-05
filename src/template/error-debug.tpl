<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{{exception_type}}: {{exception_message}}</title>
<style>
	body{
		margin:0px;
		background:lemonchiffon;
		
	}
	.current_bug{
		color:red;
	}
	.header{
		background:darkred;
		height:5px;
		
	}
	.content{
		padding-left:10px;
	}
	pre,ol,.gray{
		border: 1px solid #ccc;
		padding:20px;
		background:#fff;
		margin:0px;
		margin-bottom: 10px;

	}

	ol li{
		padding:2px 0px 2px 40px;
		border-bottom:1px solid #eee;
	}

	.gray td{
		padding:2px 0px 2px 20px;
		background:whitesmoke
	}
	ol,table{
		margin-bottom:10px;
	}
	.fatal{
		position: absolute;
		top: 0px;
		background: lemonchiffon;
	}
	
</style>
</head>
<body>
<div id="wrapper" class="{{fatal_class}}">
<div class="header"></div>

<div class="content">
	<h3>{{exception_message}}</h3>
	<table>
		<tr>
			<td width="200">Request url:</td>
			<td>{{request_url}}</td>
		</tr>
		<tr>
			<td>Request method:</td>
			<td>{{request_method}}</td>
		</tr>
		<tr>
			<td>Exception Type:</td>
			<td>{{exception_type}}</td>
		</tr>
		<tr>
			<td>Exception Code:</td>
			<td>{{exception_code}}</td>
		</tr>
		<tr>
			<td>Exception Location:</td>
			<td>{{exception_file}}:{{exception_line}}</td>
		</tr>
		<tr>
			<td>PHP Version:</td>
			<td>{{php_version}}</td>
		</tr>
	</table>
<strong>Request information</strong>
<table width="100%" cellspacing="2" cellpadding="2">
		<tr>
			<td width="200" valign="top">GET:</td>
			<td><pre>{{request_get}}</pre></td>
		</tr>
		<tr>
			<td valign="top">POST:</td>
			<td><pre>{{request_post}}</pre></td>
		</tr>
		<tr>
			<td valign="top">FILES:</td>
			<td><pre>{{request_file}}</pre></td>
		</tr>
</table>

<strong>Stack trace:</strong>
<pre>{{exception_trace}}</pre>

<strong>Server information:</strong>
{{server_info}}

<p>You're seeing this error because you enabled mode DEBUG. Change that to false, and Puja\Error will display a standard 500 page.
</p>
</div>
</div>
</body>
</html>