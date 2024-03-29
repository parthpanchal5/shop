
<ul class="sidenav collapsible expandable" id="mobile-demo">
	<li>
		<div class="user-view">
			<div class="background">
			<img src="img/back.jpeg" style="height: 820px"></div>
			<a class="sidenav-close"><i class="material-icons small white-text">arrow_back</i></a>
			<a><img class="circle right" src="img/avatar.svg"></a>
			<a><span class="white-text name"><h4><?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?></span></h4></a>
			<a><span class="white-text email"><?php echo $_SESSION['email']; ?></span></a>
		</div>
	</li>
	<li></li>
	<li class="bold"><a class="collapsible-header waves-effect" id="mobile-links">Profile <i class="material-icons grey-text right">expand_more</i></a>
		<div class="collapsible-body">
			<ul>
				<li><a href="profile.php" class="blue-text"><?php echo $_SESSION['firstname']; ?>'s Profile</a></li>
				<li><a href="logout.php" class="blue-text">Logout</a></li>			
			</ul>
		</div>
	</li>
	<li class="bold"><a class="collapsible-header waves-effect" id="mobile-links">Cart <i class="material-icons grey-text right">expand_more</i></a>
		<div class="collapsible-body">
			<ul>
				<li><a href="cart.php" class="blue-text">View Cart <i class="fa fa-shopping-cart blue-text right"></i></a></li>			
			</ul>
		</div>
	</li>
	<li class="bold"><a class="collapsible-header waves-effect" id="mobile-links">More <i class="material-icons grey-text right">expand_more</i></a>
		<div class="collapsible-body">
			<ul>
				<li><a href="sell.php" class="blue-text">Sell Products <i class="fas fa-chart-line fa-1x right blue-text"></i></a></li>
				<li><a href="ads.php" class="blue-text">Create Ads <i class="fas fa-ad fa-1x right blue-text"></i></a></li>			
			</ul>
		</div>
	</li>
	<li><div class="divider"></div></li>
	<li class="bold active"><a class="collapsible-header waves-effect" id="mobile-links">Categories <i class="material-icons grey-text right">expand_more</i></a>
		<div class="collapsible-body">
			<ul>
				<li><a href="sell.php" class="blue-text">Sell Products</a></li>
				<li><a href="ads.php" class="blue-text">Create Ads</a></li>			
			</ul>
		</div>
	</li>
</ul>

