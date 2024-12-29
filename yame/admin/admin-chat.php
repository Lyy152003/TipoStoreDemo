<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Chat</title>
    <style>
        /* Chatbox styles */
        #chatbox {
            position: fixed;
            bottom: 20px;
            left: 20px;
            width: 300px;
            height: 400px;
            border: 1px solid #ccc;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        #chatbox-body {
            padding: 15px;
            overflow-y: auto;
            background-color: #f9f9f9;
            height: 300px;
        }
        #chatbox-footer {
            display: flex;
            padding: 10px;
            border-top: 1px solid #ccc;
        }
        #chat-input {
            flex-grow: 1;
            padding: 10px;
            margin-right: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        #send-btn {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div id="chatbox">
    <div id="chatbox-body"></div>
    <div id="chatbox-footer">
        <input type="text" id="chat-input" placeholder="Nhập tin nhắn..." />
        <button id="send-btn">Gửi</button>
    </div>
</div>

<script>
    // Kết nối tới WebSocket server
    const socket = new WebSocket('ws://localhost:3000');

    socket.onmessage = (event) => {
    let message = event.data;

    // Kiểm tra nếu message là một Blob, chuyển nó thành chuỗi
    if (message instanceof Blob) {
        const reader = new FileReader();
        reader.onload = function() {
            message = reader.result;  // Chuyển Blob thành chuỗi
            const messageElement = document.createElement("div");
            messageElement.textContent = `Người dùng: ${message}`;
            document.getElementById("chatbox-body").appendChild(messageElement);
        };
        reader.readAsText(message); // Đọc Blob dưới dạng chuỗi
    } else {
        // Nếu message là chuỗi bình thường
        const messageElement = document.createElement("div");
        messageElement.textContent = `Người dùng: ${message}`;
        document.getElementById("chatbox-body").appendChild(messageElement);
    }
};


    // Gửi tin nhắn từ admin đến người dùng
    document.getElementById("send-btn").addEventListener("click", function () {
        const messageInput = document.getElementById("chat-input");
        const messageText = messageInput.value.trim();

        if (messageText !== "") {
            // Gửi tin nhắn admin đến WebSocket server
            socket.send(messageText);

            // Hiển thị tin nhắn trong chatbox
            const adminMessageElement = document.createElement("div");
            adminMessageElement.textContent = `Admin: ${messageText}`;
            document.getElementById("chatbox-body").appendChild(adminMessageElement);

            // Xoá input và cuộn xuống cuối
            messageInput.value = "";
            document.getElementById("chatbox-body").scrollTop = document.getElementById("chatbox-body").scrollHeight;
        }
    });
</script>

</body>
</html>
