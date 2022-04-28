<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="../../style/comment.css" />
  <title>Document</title>
</head>

<body>
  <?php include_once "../../includes/header.php" ?>

  <!-- Main Body -->
  <section>
    <div class="container">
      <div class="row">
        <div class="col-sm-5 col-md-6 col-12 pb-4">
          <h1>Comments</h1>
          <div class="comment mt-4 text-justify float-left">
            <img src="https://i.imgur.com/yTFUilP.jpg" alt="" class="rounded-circle" width="40" height="40" />
            <h4>Jhon Doe</h4>
            <span>- 20 October, 2018</span> <br />
            <p>
              Lorem ipsum dolor sit, amet consectetur adipisicing elit.
              Accusamus numquam assumenda hic aliquam vero sequi velit
              molestias doloremque molestiae dicta?
            </p>
          </div>
          <div class="text-justify darker mt-4 float-right">
            <img src="https://i.imgur.com/CFpa3nK.jpg" alt="" class="rounded-circle" width="40" height="40" />
            <h4>Rob Simpson</h4>
            <span>- 20 October, 2018</span> <br />
            <p>
              Lorem ipsum dolor sit, amet consectetur adipisicing elit.
              Accusamus numquam assumenda hic aliquam vero sequi velit
              molestias doloremque molestiae dicta?
            </p>
          </div>
          <div class="comment mt-4 text-justify">
            <img src="https://i.imgur.com/yTFUilP.jpg" alt="" class="rounded-circle" width="40" height="40" />
            <h4>Jhon Doe</h4>
            <span>- 20 October, 2018</span> <br />
            <p>
              Lorem ipsum dolor sit, amet consectetur adipisicing elit.
              Accusamus numquam assumenda hic aliquam vero sequi velit
              molestias doloremque molestiae dicta?
            </p>
          </div>
          <div class="darker mt-4 text-justify">
            <img src="https://i.imgur.com/CFpa3nK.jpg" alt="" class="rounded-circle" width="40" height="40" />
            <h4>Rob Simpson</h4>
            <span>- 20 October, 2018</span> <br />
            <p>
              Lorem ipsum dolor sit, amet consectetur adipisicing elit.
              Accusamus numquam assumenda hic aliquam vero sequi velit
              molestias doloremque molestiae dicta?
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-5 col-sm-4 offset-md-1 offset-sm-1 col-12 mt-4">
          <form id="algin-form">
            <div class="form-group">
              <h4>Leave a comment</h4>
              <label for="message">Message</label>
              <textarea name="msg" id="" msg cols="30" rows="5" class="form-control" style="background-color: black"></textarea>
            </div>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" id="fullname" class="form-control" />
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" name="email" id="email" class="form-control" />
            </div>
            <div class="form-group">
              <p class="text-secondary">
                If you have a
                <a href="#" class="alert-link">gravatar account</a> your
                address will be used to display your profile picture.
              </p>
            </div>
            <div class="form-inline">
              <input type="checkbox" name="check" id="checkbx" class="mr-1" />
              <label for="subscribe">Subscribe me to the newlettter</label>
            </div>
            <div class="form-group">
              <button type="button" id="post" class="btn">
                Post Comment
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</body>

</html>