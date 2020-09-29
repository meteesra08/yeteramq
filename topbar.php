<div class="collapse navbar-collapse" id="joseph-photos-nav-collapse">
					<ul class="nav navbar-nav">
						<li><a href="index.php"><i class="fa fa-home"></i>   Ana Sayfa</a></li>
						<?php 
					session_start();
 
					if(isset($_SESSION["user_nick"])){
					echo '<li><a href="profil.php"><i class="fa fa-user"></i>   Profil</a></li>';
					echo '<li style="font-family: Raleway;"><a href="dst.php"><i class="fa fa-ticket"></i>   Destek</a></li>';
    				echo '<li style="font-family: Raleway;"><a href="market.php"><i class="fa fa-shopping-cart"></i>   Market</a></li>';
    				echo '<li style="font-family: Raleway;"><a href="krediyukle.php"><i class="fa fa-plus-circle"></i>   Kredi Yükle</a></li>';
    				echo '<li style="font-family: Raleway;"><a href="kupon.php"><i class="fa fa-ticket"></i>   Kupon Kodu Kullan</a></li>';
    				echo '<li style="font-family: Raleway;"><a href="cikisyap.php"><i class="fa fa-sign-out"></i>   Çıkış Yap</a></li>';
					}else{

					}
					
					?>		
					</ul>
				</div>