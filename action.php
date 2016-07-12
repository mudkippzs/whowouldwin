<?php 
//include the header 
include_once './resources/header.php';
if(is_user_logged_in()!= FALSE){ 
?>

<div class='header_wrapper'>
	<div class='header_inner'>
		<h1>Create a Hero</h1>
	</div>
</div>
<div class='main_wrapper'>
	<div class='main_inner'>
		<?php include './resources/new_hero_form.php'; ?>
	</div>

	<div class='main_tower'>
		<h2>Creating a Hero</h2>
		<p>
		Give them a name, select their stats and use the scales to estimate their ability. This can be tweaked at any time but go with your gut if you don't have any sources.
		</p>
		<h2>Powers</h2>
		<p>
		Select a power type: Offensive, Defensive or Utility from the top of the form. Then add in the details and attributes for the powers.
		<p><strong>Offensive</strong><br><br>
			These are powers who's main effect is dealing damage in some shape or form. Either direct, physical damage, energy damage or status changes that inflict damage.
			<br><br>
			They're also something that contributes to collateral damage on a battlemap. This can be advantagious or disadvantagious to the hero! With the system of 'advantages, plot twists, weaknesses and challenges' incoming, this will play a strong role in the completion or failure of missions and survivability in Battle Royal/Survivor tournaments.
		</p>
		<p><strong>Defensive</strong><br><br>
			The polar opposite to offense. The main priority for defensive abilities are those that protect the welfare of the hero. This can be anything provided it's stated effects aren't offensive. Some abilities can be both offensive and defensive and you can create power templates for both uses. These are not supposed to be unique. It's totally up to you how you define the hero.
			<br><br>
			They will play a large role in missions and survior play. Any passive abilities that have a beneficial effect to a hero or reduce the % of collateral damage would also fall into here.
		</p>
		<p><strong>Utility</strong><br><br>
			Anything that serves to boost a heroes attributes directly, an allies or to affect collateral damage directly would be considered Utiltiy. Utility can have offensive or defensive benefits for all heroes in it's range. It also effects the chance of plot twists occuring in favor of the hero using it. Sometimes with suprising consequences!		
		</p>
		</p>	
	</div>
</div>

<?php 
}
//include the footer
include_once './resources/footer.php'; 
?>
