
<h1 align="left">Kapda Mini Project</h1>
<h3 align="left">A PHP E-Commerce Clothing Website</h1>
<p clign="left">The Kapda Mini Project is a simple e-commerce clothing website developed using PHP. It serves as a learning platform for practicing CRUD (Create, Read, Update, Delete) operations and implementing basic e-commerce functionality.</p>

![Header](https://raw.githubusercontent.com/diwashTiwari/Mini-Cloth/master/assets/images/kapdaCoverImage.png "Header")

## Configuration

### Configure my-project <br/>

- clone my-project  <br/>
- navigate to dbConfig.php <br/>
- change the credentials <br/>

```bash
  // use your own credentials
  $hostname = "";
  $username = "";
  $password = "";
  $db = "";

  $conn = mysqli_connect($hostname, $username, $password, $db);
```

### Create Tables in Database

```bash
  Table Users => Attributes => user_img, fname, lname, email, password
  Table Products => Attributes => product_img, title, price, description,
```

## Tech Stack

HTML, CSS, JavaScript, PHP, MySQL 


