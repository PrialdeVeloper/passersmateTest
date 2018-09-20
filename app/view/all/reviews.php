<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="modal-body bg-white">
		<div class="container border">
			<div class="row justify-content-center pt-3">
				<div>
					<img class="img-fluid imageReview rounded-circle" src="../etc/images/user/marvee.jpg" alt="image">
				</div>
			</div>
			<div class="row justify-content-center pt-2">
				<label>
					<i class="fas fa-star hoverRating text-warning"></i>
					<i class="fas fa-star hoverRating text-warning"></i>
					<i class="fas fa-star hoverRating text-warning"></i>
					<i class="fas fa-star hoverRating text-warning"></i>
					<i class="fas fa-star hoverRating text-warning"></i>
				</label>
			</div>
			<div class="row justify-content-center">
				<label><?=$rate;?></label>
			</div>
			<div class="row pt-3">
				<div class="container">
					<blockquote class="blockquote lead">
						  <p>Maayo kaayo ni siya mo dala, tapulan lang gud kaayo. Pero pang Wife material gud ni siya.</p>
						  <footer class="blockquote-footer text-right"><?=$reviewer;?></footer>
					</blockquote>
				</div>
			</div>
		</div>
	</div>
</body>
</html>