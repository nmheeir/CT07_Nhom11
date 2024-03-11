<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        ::selection {
            color: #fff;
            background: #4671EA;
        }

        .wrapper {
            align-items: center;
            margin: 200px auto;
            width: 470px;
            background: transparent;
            border-radius: 5px;
            padding: 25px 25px 30px;
            box-shadow: 8px 8px 10px rgba(0, 0, 0, 0.06);
        }

        .wrapper textarea {
            width: 100%;
            resize: none;
            height: 59px;
            outline: none;
            padding: 15px;
            font-size: 16px;
            margin-top: 20px;
            border-radius: 5px;
            max-height: 330px;
            caret-color: #4671EA;
            border: 1px solid #bfbfbf;
        }

        textarea::placeholder {
            color: #b3b3b3;
        }

        textarea::-webkit-scrollbar {
            width: 0px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h3 class="text-white text-center">Send Complain Mail</h3>
        <form method="post">
            <select name="type" class="form-select">
                <option value="1">Wesite</option>
                <option value="2">Đơn hàng</option>
                <option value="3">Dịch vụ</option>
            </select>
            <textarea class="form-control" spellcheck="false" placeholder="Type something here..." name="complainMail" required></textarea>
            <button type="submit" class="btn btn-primary mt-3" name="btnSendComplainMail">Send</button>
        </form>
    </div>
</body>

</html>

<script>
    const textarea = document.querySelector("textarea");
    textarea.addEventListener("keyup", e => {
        textarea.style.height = "63px";
        let scHeight = e.target.scrollHeight;
        textarea.style.height = `${scHeight}px`;
    });
</script>