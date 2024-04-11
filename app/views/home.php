<h2>Users</h2>


<ul id="users-home">
     <?php foreach($users as $user): ?>

        <li><?php echo $user->nome ?> | <a href="/user/<?php echo $user->id ?>">Detalhes</a></li>

      <?php endforeach ?>  

      
</ul>