<h2>create</h2>
<?php $this->layout('master', ['title' => $title]) ?>

<?php echo getFlash('message'); ?>

<form action="/user/store" method="POST">

   <?php echo getCsrf(); ?>

    <input type="text" name="nome" placeholder="nome" value=""<?php echo getOld('nome') ?>>
    <?php echo getFlash('nome'); ?>
    <br>
    <br>
    
    <input type="text" name="sobrenome" placeholder="sobrenome" value=""<?php echo getOld('sobrenome') ?>>
    <?php echo getFlash('sobrenome'); ?>
    <br>
    <br>
    
    <input type="email" name="email" placeholder="email" value=""<?php echo getOld('email') ?>>
    <?php echo getFlash('email'); ?>
    <br>
    <br>
    
    <input type="password" name="password" placeholder="password" value=""<?php echo getOld('password') ?>>
    <?php echo getFlash('password'); ?>
    <br>
    <br>

    <button type="submit">Cadastrar</button>
  

</form>