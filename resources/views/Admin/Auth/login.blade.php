<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Login | WECONNECTT</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<style>
    @font-face {
    font-family: 'Gordita';
    src: url('/fonts/Gordita-Medium.ttf');
   
}
    body {
        font-family: 'Gordita', sans-serif ;
  margin: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  background-color: #f5f5f5;
  color: #333;
}

.container {
  width: 100%;
  max-width: 400px;
}

.card {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
}

form {
  display: flex;
  flex-direction: column;
}

input {
  padding: 10px;
  margin-bottom: 12px;
  border: 1px solid #ddd;
  border-radius: 4px;
  transition: border-color 0.3s ease-in-out;
  outline: none;
  color: #333;
}

input:focus {
  border-color: #555;
}

button {
  background-color: #555;
  color: #fff;
  padding: 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease-in-out;
}

button:hover {
  background-color: #333;
}

</style>
<body><!-- Section: Design Block -->
<div class="container">
  <div class="card">
    <h2>Login</h2>
            @if(session('success'))
              <div class="text-success fade show mt-4 mb-2" >
                <i class="bi bi-check2-circle me-1 fs-16"></i> {{ session('success') }}
              </div>
            @endif

            @if(session('error'))
              <div class="text-danger fade show mt-4 mb-2" >
                <i class="bi bi-exclamation-triangle me-1 fs-16"></i> {{ session('error') }}
              </div>
            @endif

    <form method="POST" action="{{ route('admin.authenticate') }}">
        @csrf
      <input type="email" id="username" name="email" placeholder="Email" required >
      <input type="password" id="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
  </div>
</div>
</body>
</html>