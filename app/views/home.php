<?php $this->layout('master', ['title' => $title]) ?>
<h2>Users</h2>


<div x-data="users()" x-init="loadUsers()">
    <ul>
        <template x-for="user in data">
           <li x-text="user.nome"></li>
        </template>
    </ul>

</div>


<ul id="users-home">

     <?php foreach($users as $user): ?>
        <li><?php echo $user->nome ?> | <a href="/user/<?php echo $user->id ?>">Detalhes</a></li>
      <?php endforeach ?>  
   
</ul>

