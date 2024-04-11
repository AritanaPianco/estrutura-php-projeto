<h2>create</h2>
<?php echo getFlash('message'); ?>

<form action="/user/store" method="POST">

    <input type="text" name="nome" placeholder="nome">
    <?php echo getFlash('nome'); ?>
    <br>
    <br>
    
    <input type="text" name="sobrenome" placeholder="sobrenome">
    <?php echo getFlash('sobrenome'); ?>
    <br>
    <br>
    
    <input type="email" name="email" placeholder="email">
    <?php echo getFlash('email'); ?>
    <br>
    <br>
    
    <input type="password" name="password" placeholder="password">
    <?php echo getFlash('password'); ?>
    <br>
    <br>

    <button type="submit">Cadastrar</button>
  

</form>