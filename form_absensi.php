<!DOCTYPE html>
<html>
<head>
  <title>Import ABSENSI</title>
</head>
<body>
  <h2>Upload tarikFBabsensi.xlsx</h2>
  <form action="import_absensi.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file_excel" accept=".xls,.xlsx" required>
    <button type="submit">Import ABSENSI</button>
  </form>
</body>
</html>
