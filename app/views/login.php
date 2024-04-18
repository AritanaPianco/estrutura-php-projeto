<?php $this->layout('master', ['title' => $title]) ?>

<h2>login</h2>
<?php echo getFlash('message'); ?>

 
<?php if(!logged()) : ?>
<form id="box-login" action="/login" method="post">

    <input type="text" name="email" placeholder="email" value="aritana@gmail.com">
    
    <input type="password" name="password" placeholder="password" value="234">

    <button type="submit">Login</button>

</form>

<?php else :?>
   <h2>Já esta logado</h2>

<?php endif ?>