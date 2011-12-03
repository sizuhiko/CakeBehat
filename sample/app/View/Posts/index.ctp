<!-- File: /app/View/Posts/index.ctp -->

<h1>Blog posts</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Created</th>
        <th>&nbsp;</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php $index = 1; ?> 
    <?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($post['Post']['title'],
array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
        </td>
        <td><?php echo $post['Post']['created']; ?></td>
        <td><a href="javascript:void(0);" onclick="$(this).closest('tr').remove();">Delete<?php echo $index++; ?></a>
    </tr>
    <?php endforeach; ?>

</table>

<?php $this->Html->script('jquery-1.6.4.min', array('inline'=>false)); ?>