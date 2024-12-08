<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Suggestion - SimpleChat</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
            transition: color 0.3s;
        }

        a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        body {
            /* font-family: Arial, sans-serif; */
            margin: 0;
            padding: 0;
            /* background-color: #f4f4f4; */
        }

        .chat-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            z-index: 1000;
        }

        .msger {
            display: none;
            flex-direction: column;
            height: 400px;
            width: 300px;
            margin: auto;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: white;
            position: fixed;
            bottom: 80px;
            right: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            z-index: 1001;
        }

        .msger-header {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .msger-chat {
            flex: 1;
            overflow-y: auto;
            padding: 10px;
        }

        .msg {
            display: flex;
            margin-bottom: 10px;
        }

        .msg.left-msg {
            flex-direction: row;
        }

        .msg.right-msg {
            flex-direction: row-reverse;
        }

        .msg-img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-size: cover;
            margin: 0 10px;
        }

        .msg-bubble {
            max-width: 80%;
            padding: 10px;
            border-radius: 10px;
            background-color: #e6e6e6;
            /* Default bot color */
        }

        .msg.right-msg .msg-bubble {
            background-color: #4CAF50;
            /* User message bubble color */
            color: white;
            /* User message text color */
        }

        .msg-info {
            display: flex;
            justify-content: space-between;
        }

        .msg-info-name {
            font-weight: bold;
        }

        .msger-inputarea {
            display: flex;
            padding: 10px;
            border-top: 1px solid #ccc;
        }

        .msger-input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .msger-send-btn {
            padding: 10px;
            border: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <button class="chat-button" onclick="toggleChat()">
        <i class="fas fa-comment-alt"></i>
    </button>

    <section class="msger" id="chat">
        <header class="msger-header">
            <div class="msger-header-title">
                <i class="fas fa-comment-alt"></i> Chat nè
            </div>
            <div class="msger-header-options" onclick="toggleChat()">
                <span><i class="fas fa-times"></i></span>
            </div>
        </header>

        <main class="msger-chat">
            <div class="msg left-msg">
                <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)">
                </div>
                <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">BOT</div>
                    </div>
                    <div class="msg-text">Xin chào, uit có thể giúp gì cho bạn. 😄</div>
                </div>
            </div>
        </main>

        <form class="msger-inputarea" onsubmit="submitQuery(event)">
            <input type="text" class="msger-input" id="query" placeholder="Enter your message..." required>
            <button type="submit" class="msger-send-btn">Gửi</button>
        </form>
    </section>

    <script>
        function toggleChat() {
            const chat = document.getElementById('chat');
            chat.style.display = chat.style.display === 'none' || chat.style.display === '' ? 'flex' : 'none';
        }

        async function submitQuery(event) {
            event.preventDefault();
            const query = document.getElementById('query').value;
            const chat = document.getElementById('chat').querySelector('.msger-chat');

            chat.innerHTML += `
                <div class="msg right-msg">
                    <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)"></div>
                    <div class="msg-bubble">
                        <div class="msg-info">
                            <div class="msg-info-name">You</div>
                            <div class="msg-info-time">${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</div>                        </div>
                        <div class="msg-text">${query}</div>
                    </div>
                </div>
            `;
            document.getElementById('query').value = '';

            try {
                const res = await fetch('http://127.0.0.1:6969/api/suggest', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        query
                    }),
                });

                if (!res.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await res.json();
                const botResponse = data.response || 'No response received.';
                console.log(data.response);
                const formattedResponse = botResponse.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>').replace(/\n/g,'<br>');
                // const formattedResponse = botResponse.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>').replace(/\n/g, '<br>').replace(/([^\(]+ \(ID: (\d+)\))/g, (match, p1, p2) => {
                //         return `<strong><a href="http://127.0.0.1:8000/products/${p2}">${p1}</a> (ID: ${p2})</strong>`;
                //     });

                chat.innerHTML += `
                    <div class="msg left-msg">
                        <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"></div>
                        <div class="msg-bubble">
                            <div class="msg-info">
                                <div class="msg-info-name">BOT</div>
                                <div class="msg-info-time">${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</div>
                            </div>
                            <div class="msg-text">${formattedResponse}</div>
                        </div>
                    </div>
                `;

                chat.scrollTop = chat.scrollHeight;
            } catch (error) {
                console.error('Error:', error);
            }
        }
    </script>
</body>

</html>
