<?php
	include('inc/header.php');
?>
	<div class="col-md-6 col-md-offset-3">
		<div class='col-xs-12' style="margin-top:40px;padding-top:10px;border-radius:5px;min-height:400px;background:#fff;">
			<table class="table table table-striped" id='sysinfo'>
                    <thead>
						<tr><th class='text-center' colspan=4>Current Operation Environment</th></tr>
                        <tr>
                            <th class="text-center">Environment</th>
                            <th class="text-center" colspan=3>Current</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Server Operation System</td>
                            <td class="text-center" colspan=3><div class="label label-warning"><?php echo PHP_OS;?></div></td>
                        </tr>
                        <tr>
							<td>PHP Version</td>
							<td class="text-center" colspan=3><?php echo $_SERVER["SERVER_SOFTWARE"];?></td>
						</tr>
                        <tr>
							<td>MySQL Version</td>
							<td class="text-center" colspan=3><?php 
							if(function_exists('mysqli_connect')){
								if(file_exists('inc/db.php')){
									include('inc/db.php');
									echo mysqli_get_server_info($mysql->conn);
								}else{
									echo '<i class="fa fa-close"></i>Error: db.php is not exists';
								}
							}else{
								echo '<i class="fa fa-close"></i>Error: mysqli() is Not Supported';
							}
							?></td>
						</tr>
                        <tr>
                            <td>Client Browser</td>
							<td class="text-center" colspan=3><?php
								function getBrowser(){
									$agent=$_SERVER["HTTP_USER_AGENT"];
									if(strpos($agent,'MSIE')!==false || strpos($agent,'rv:11.0')) //IE11?
									return "IE";
									else if(strpos($agent,'Firefox')!==false)
									return "Firefox";
									else if(strpos($agent,'Chrome')!==false)
									return "Chrome";
									else if(strpos($agent,'Opera')!==false)
									return 'Opera';
									else if((strpos($agent,'Chrome')==false)&&strpos($agent,'Safari')!==false)
									return 'Safari';
									else 
									return 'Unknown';
								}
								echo getBrowser();
							?></td>
                        </tr>
						<tr>
                            <td>Upload Limit</td>
							<td class="text-center" colspan=3><?php echo ini_get('upload_max_filesize');?></td>
                        </tr>
						<tr>
                            <td>Execution Time Limit</td>
							<td class="text-center" colspan=3><?php echo ini_get('max_execution_time').'s';?></td>
                        </tr>
						<tr>
                            <td>Remaing Storage</td>
							<td class="text-center" colspan=3><?php echo ROUND((@disk_free_space(".") / (1024 * 1024)), 2).'M';?></td>
                        </tr>
                        <tr>
                            <td>SSL</td>
							<td class="text-center" colspan=3><?php echo isset($_SERVER['HTTPS'])?'<i class="fa fa-check"></i>Supported':'<i class="fa fa-close"></i>Not Supported';?></td>
                        </tr>
						<tr>
                            <td>SESSION</td>
							<td class="text-center" colspan=3><?php echo function_exists('session_start')?'<i class="fa fa-check"></i>Supported':'<i class="fa fa-close"></i>Not Supported';?></td>
                        </tr>
						<tr>
                            <td>Atrigger Verify</td>
							<td class="text-center" colspan=3><?php echo file_exists('../ATriggerVerify.txt')?'<i class="fa fa-check"></i>Supported':'<i class="fa fa-close"></i>Not Supported';?></td>
                        </tr>
						<tr>
                            <td>PHPMailer</td>
							<td class="text-center" colspan=3><?php echo file_exists('../vendor/autoload.php')?'<i class="fa fa-check"></i>Supported':'<i class="fa fa-close"></i>Not Supported';?></td>
                        </tr>
						<tr>
                            <td>Vue.js</td>
							<td class="text-center" colspan=3><?php echo file_exists('static/lib/vue.js')?'<i class="fa fa-check"></i>Supported':'<i class="fa fa-close"></i>Not Supported';?></td>
                        </tr>
						<tr>
                            <td>Chrome Notification</td>
							<td class="text-center" colspan=3 id='isNoti'><div class='js-log'><i class="fa fa-check"></i>Supported</div></td>
                        </tr>
						<input type='hidden' class="js-push-button"/>
						<script src="noti/config.js"></script>
						<script src="noti/demo.js"></script>
						<script src="noti/main.js"></script>
                        <tr>
                            <th class="text-center">Directory Authority</th><th class="text-center" colspan="2">Write</th><th class="text-center">Read</th>
                        </tr>
                    <?php
						$folder = array(
							'/',
							'/../',
							'/../vendor/',
						);
						$cwd = __dir__;
						for($i=0;$i<count($folder);$i++){
							$path = $cwd.$folder[$i];
							if(is_readable($path)){
								$readable = '<i class="fa fa-check"></i>Readable';
							}else{
								$readable = '<i class="fa fa-close"></i>Not Readable';
							}
							if(is_writable($path)){
								$writeable = '<i class="fa fa-check"></i>Writable';
							}else{
								$writeable = '<i class="fa fa-close"></i>Not Writable ';
							}
							echo "<tr>
                                <td>".$path."</td>
                                <td colspan=2 class='text-center'>$writeable</td>
                                <td>$readable</td>
                            </tr>";
						}
                    ?>
                    </tbody>
            </table>
		</div>
	</div>
