			<?php
			if ($_SESSION['username'] !== '') {
			?>
				<div id="modal" class="mod">
					<form action="" id="voting-form" method="POST">
						<?php
						$select = "SELECT ID_film from voting";
						$result = mysqli_query($link, $select) or die("Ошибка " . mysqli_error($link));
						$row = mysqli_fetch_row($result);
						$ro = explode(',', $row[0]);
						$count = count($ro);

						$selectFilm = "SELECT ID_film, title from films";
						$resultFilm = mysqli_query($link, $selectFilm) or die("Ошибка " . mysqli_error($link));
						$rowsFilm = mysqli_num_rows($resultFilm);
						for ($i = 0; $i < $rowsFilm; ++$i) {
							$rowFilm = mysqli_fetch_row($resultFilm);

							for ($p = 0; $p < $count - 1; $p++) {

								if ($rowFilm[0] == $ro[$p]) {
									echo "<input type='radio'name='voting' class='radio-voting' id='radio-voting' value=" . $rowFilm[0] . ">" . $rowFilm[1];
									echo "<br>";
								}
							}
						}
						?>
						<input type="submit" id="voting" value="Проголосовать" name="voting-btn">
					</form>
				</div>
			<?php } ?>