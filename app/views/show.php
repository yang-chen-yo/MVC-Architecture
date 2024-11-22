<?php require APP_ROOT . 'views/include/header.php'; ?>

<div class="container px-3 py-5">
  <div class="card shadow-lg">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0">Data Information</h5>
    </div>
    <div class="card-body">
      <table class="table table-striped table-hover">
        <thead class="table-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Body</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td><?= $data['id'] ?></td>
            <td><?= $data['title'] ?></td>
            <td><?= $data['body'] ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer text-end">
      <a href="<?= URL_ROOT ?>" class="btn btn-secondary">Back</a>
    </div>
  </div>
</div>
