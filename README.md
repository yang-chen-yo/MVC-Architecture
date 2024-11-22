# MVC-Architecture
http://127.0.0.1/MVC-Architecture/public/?url=post/show 確認完成
PostController.php 中的 $this->view('show', $data);
代表將$data這個變數 丟到 show 這裡
會去引入Views/show.php，得到的數據 會存在$data中

注意 
前端得到的值 都會放在$data這名稱
後端傳過來的view('前端檔案名稱','要傳的資料變數')


DB連線資訊 只要改.env里的值即可
