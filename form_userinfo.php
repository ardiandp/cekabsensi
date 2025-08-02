<!DOCTYPE html>
<html>
<head>
  <title>Import USERINFO</title>
</head>
<body>
  <h2>Upload USERINFO.xlsx</h2>
  <form action="import_userinfo.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file_excel" accept=".xls,.xlsx" required>
    <button type="submit">Import USERINFO</button>
  </form>
</body>
</html>
