<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="UTF-8" />
  <title>OpenSpace</title>
  <link rel="stylesheet" type="text/css" href="../css/demo.css" />
  <link rel="stylesheet" type="text/css" href="../css/food.css" />
</head>

<body>
  <?php
  include '../menu/menu.php';
  ?>
  <main>
    <div class="content-food">
      <div class="title">
        <h1>Еда и напитки</h1>
      </div>

      <form method="POST">
        <div class="input">
          <div class="inputGroup">
            <input type="radio" name="food" id="popcorn" value="popcorn"/>
            <label for="popcorn">Попкорн</label>
          </div>

          <div class="inputGroup">
            <input type="radio" name="food" id="dessert" value="dessert" />
            <label for="dessert">Десерт</label>
          </div>
          <div class="inputGroup">
            <input type="radio" name="food" id="drink" value="drink" />
            <label for="drink">Напитки</label>
          </div>
        </div>
        <div class="form-line">
          <hr size="1" align="center">
        </div>
      </form>
    </div>
    <div id='food-content'></div>
  </main>
  <?php
  include '../footer/footer.php';
  ?>
  <script type="text/javascript">
    $('html').keydown(function(e){
      if (e.keyCode == 116) {
        e.preventDefault();
      }
    });
    $(() => {
      $('#dessert').removeAttr('checked');
      $('#drink').removeAttr('checked');
      $('#popcorn').attr('checked', true);
      $('#food-content').load('../food/popcorn.php');
    });
    $('#popcorn').click(() => {
      $('#dessert').removeAttr('checked');
      $('#drink').removeAttr('checked');
      $('#popcorn').attr('checked', true);
      $('#food-content').load('../food/popcorn.php');
    });
    $('#dessert').click(() => {
      $('#popcorn').removeAttr('checked');
      $('#drink').removeAttr('checked');
      $('#dessert').attr('checked', true);
      $('#food-content').load('../food/dessert.php');
    });
    $('#drink').click(() => {
      $('#dessert').removeAttr('checked');
      $('#popcorn').removeAttr('checked');
      $('#drink').attr('checked', true);
      $('#food-content').load('../food/drink.php');
    });
  </script>
</body>

</html>