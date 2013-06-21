<?php include 'includes/core/document_head.php'?>
	<div id="pjax">
		<div id="wrapper" data-adminica-nav-top="7" data-adminica-nav-inner="2">
			<?php include 'includes/components/topbar.php'?>
			<?php include 'includes/components/sidebar.php'?>
			<?php include 'includes/components/stackbar.php'?></div><!-- Closing Div for Stack Nav, you can boxes under the stack before this -->
			<div id="main_container" class="main_container container_16 clearfix">
				<?php include 'includes/components/navigation.php'?>
				<div class="flat_area grid_16">
					<h2><?php echo $title['top'];?>
						<div class="holder">
							<?php include 'includes/components/dynamic_loading.php'?>
						</div>
					</h2>
				</div>
				<!-- 编辑窗口 -->
				<div class="box grid_8 light">
					<h2 class="box_head">用户信息编辑</h2>
					<div class="controls">
						<a style="cursor:pointer" class="grabber"></a>
						<a style="cursor:pointer" class="toggle"></a>
					</div>
					<div class="toggle_container">
						<div class="block">
							<div class="columns clearfix">
								<div class="col_25">
									<div class="section">
										<img id="contactImage" width="55" alt="Profile Pic" src="images/content/profiles/mangatar-0.png">
									</div>
								</div>
								<div class="col_75">
									<div class="section">
										<h2 id="contactName">Adam</h2>
										<h3 id="contactEmail">adam@gmail.com</h3>
									</div>
								</div>
							</div>
							<div class="columns clearfix">
								<div class="col_100">
									<fieldset class="label_side top">
										<label>人员类型</label>
										<div>
											<select class="select_box">
											<?php foreach($user_group as $key => $value){?>
												<option value="<?php echo $key;?>"><?php echo $value;?></option>
												<?php  }?>
											</select>
										</div>
									</fieldset>
									<fieldset class="label_side">
										<label>Phone Number<span>Required</span></label>
										<div>
											<input type="text">
										</div>
									</fieldset>

									<fieldset class="label_side">
										<label>Address</label>
										<div class="clearfix">
											<textarea></textarea>
										</div>
									</fieldset>

									<fieldset class="label_side bottom">
										<label>Active</label>
										<div class="uniform inline clearfix">
											<label for="yes3"><input type="radio" name="answer3" id="yes3"/>Yes</label>
											<label for="no3"><input type="radio" name="answer3" id="no3"/>No</label>
										</div>
									</fieldset>
								</div>
							</div>
							<div class="button_bar clearfix">
								<button class="dark">
									<img src="images/icons/small/white/bended_arrow_right.png">
									<span>Save</span>
								</button>

								<button class="dialog_button red send_right" data-dialog="delete">
									<img src="images/icons/small/white/trashcan.png">
									<span>Delete</span>
								</button>
							</div>
						</div>
					</div>
				</div>
				<!-- ############# -->
				<div class="box grid_7">
					<h2 class="box_head">用户列表</h2>
					<div id="slider_list">
						<div class="slider-content">
							<ul>
								<li id="a"><a name="a" class="title">A</a>
									<ul>
										<li><a style="cursor:pointer">Adam<span>adam@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Alex<span>alex@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Ali<span>ali@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Apple<span>apple@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Arthur<span>arthur@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Ashley<span>ashley@gmail.com</span></a></li>
	
									</ul>
								</li>
								<li id="b"><a name="b" class="title">B</a>
									<ul>
										<li><a style="cursor:pointer">Barry<span>Barry@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Becky<span>Becky@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Biff<span>Biff@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Billy<span>Billy@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Bozarking<span>Bozarking@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Bryan<span>Bryan@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="c"><a name="c" class="title">c</a>
									<ul>
										<li><a style="cursor:pointer">Calista<span>Calista@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Cathy<span>Cathy@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Chris<span>Chris@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Cinderella<span>Cinderella@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Corky<span>Corky@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Cypher<span>Cypher@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="d"><a name="d" class="title">d</a>
									<ul>
										<li><a style="cursor:pointer">Damien<span>Damien@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Danny<span>Danny@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Denver<span>Denver@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Devon<span>Ddevon@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Doug<span>Doug@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Dustin<span>Dustin@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="e"><a name="e" class="title">E</a>
									<ul>
										<li><a style="cursor:pointer">Eavan<span>Eavan@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Elton<span>Elton@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Emma<span>Emma@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Ernesto<span>Ernesto@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="f"><a name="f" class="title">f</a>
									<ul>
										<li><a style="cursor:pointer">Falon<span>Falon@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Fernanda<span>Fernanda@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Fernando<span>Fernando@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Fionn<span>Fionn@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Frank<span>Frank@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="g"><a name="g" class="title">g</a>
									<ul>
										<li><a style="cursor:pointer">Gavin<span>Gavin@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Gary<span>Gary@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Gerry<span>Gerry@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Gina<span>Gina@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Greg<span>Greg@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="h"><a name="h" class="title">h</a>
									<ul>
										<li><a style="cursor:pointer">Harry<span>Harry@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Harold<span>Harold@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Harriot<span>Harriot@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Hermione<span>Hermione@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="i"><a name="i" class="title">i</a>
									<ul>
										<li><a style="cursor:pointer">Ian<span>Ian@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Ifan<span>Ifan@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Igor<span>Igor@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="j"><a name="j" class="title">j</a>
									<ul>
										<li><a style="cursor:pointer">Jake<span>Jake@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Jane<span>Jane@gmail.com</span></a></li>
										<li><a style="cursor:pointer">June<span>June@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="k"><a name="k" class="title">k</a>
									<ul>
										<li><a style="cursor:pointer">Kate<span>Kate@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Katherine<span>Katherine@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Kerry<span>Kerry@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="l"><a name="l" class="title">l</a>
									<ul>
										<li><a style="cursor:pointer">Layton<span>Layton@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Lester<span>Lester@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Luke<span>Luke@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="m"><a name="m" class="title">m</a>
									<ul>
										<li><a style="cursor:pointer">Mark<span>Mark@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Mary<span>Mary@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Minny<span>Minny@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="n"><a name="n" class="title">n</a>
									<ul>
										<li><a style="cursor:pointer">Nathan<span>Nathan@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Neil<span>Neil@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Nina<span>Nina@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="o"><a name="o" class="title">o</a>
									<ul>
										<li><a style="cursor:pointer">Oisin<span>Oisin@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Oliver<span>Oliver@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Oran<span>Oran@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="p"><a name="p" class="title">p</a>
									<ul>
										<li><a style="cursor:pointer">Patrick<span>Patrick@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Peter<span>Peter@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Petunia<span>Petunia@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Pinto<span>Pinto@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="q"><a name="q" class="title">q</a>
									<ul>
										<li><a style="cursor:pointer">Quinn<span>Quinn@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="r"><a name="r" class="title">r</a>
									<ul>
										<li><a style="cursor:pointer">Raif<span>Raif@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Rachel<span>Rachel@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Reginald<span>Reginald@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="s"><a name="s" class="title">s</a>
									<ul>
										<li><a style="cursor:pointer">Sam<span>Sam@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Sarah<span>Sarah@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Seneca<span>Seneca@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Sunny<span>Sunny@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="t"><a name="t" class="title">t</a>
									<ul>
										<li><a style="cursor:pointer">Tara<span>Tara@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Tarquin<span>Tarquin@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Ted<span>Ted@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Timmy<span>Timmy@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Triona<span>Triona@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="u"><a name="u" class="title">u</a>
									<ul>
										<li><a style="cursor:pointer">Ultan<span>Ultan@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Ursula<span>Ursula@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="v"><a name="v" class="title">v</a>
									<ul>
										<li><a style="cursor:pointer">Valiant<span>Valiant@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Vanessa<span>Vanessa@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Veronica<span>Veronica@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Victor<span>Victor@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="w"><a name="w" class="title">w</a>
									<ul>
										<li><a style="cursor:pointer">Walter<span>Walter@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Wendy<span>Wendy@gmail.com</span></a></li>
										<li><a style="cursor:pointer">William<span>William@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Willow<span>Willow@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="x"><a name="x" class="title">x</a>
									<ul>
										<li><a style="cursor:pointer">Xander<span>Xander@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Xavier<span>Xavier@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Xin<span>Xin@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="y"><a name="y" class="title">y</a>
									<ul>
										<li><a style="cursor:pointer">Yasmin<span>Yasmin@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Yoko<span>Yoko@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Yousuf<span>Yousuf@gmail.com</span></a></li>
									</ul>
								</li>
								<li id="z"><a name="z" class="title">z</a>
									<ul>
										<li><a style="cursor:pointer">Zac<span>Zac@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Zara<span>Zara@gmail.com</span></a></li>
										<li><a style="cursor:pointer">Zelda<span>Zelda@gmail.com</span></a></li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<?php include 'includes/dialogs/dialog_welcome.php'?>
		<?php include 'includes/dialogs/dialog_logout.php'?>
<?php include 'includes/core/document_foot.php'?>