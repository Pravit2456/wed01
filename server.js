const express = require('express');
const path = require('path');
const app = express();
const port = 3000;

// ให้บริการไฟล์ HTML จากโฟลเดอร์ public
app.use(express.static(path.join(__dirname, 'public')));

// กำหนด route สำหรับหน้า main.html
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'main.html'));
});

// รัน server
app.listen(port, () => {
  console.log(`Server is running at http://localhost:${port}`);
});
