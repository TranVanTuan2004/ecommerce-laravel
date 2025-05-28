<div class="comments-container">
    @foreach ($reviews as $review)
        <div class="comment-box">
            <div class="comment-header">
                <div class="avatar">
                    <img src="{{ asset($review->user->avatar ?? 'storage/avatars/clone.png') }}" alt="User Avatar">

                </div>
                <div class="user-info">
                    <span class="username">{{ $review->user->name }}</span>
                    <span class="badge autor">autor</span>
                    <span class="time">20 minutes ago</span>
                </div>
            </div>
            <div class="comment-body">
                <p>{{ $review->review_text }}</p>
            </div>
            <div class="rating">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $review->rating)
                        <i class="fas fa-star"></i>
                    @else
                        <i class="far fa-star"></i>
                    @endif
                @endfor
            </div>
            <div class="comment-actions">
                <button class="like-btn"><i class="far fa-heart"></i></button>
                <button class="reply-btn"><i class="far fa-reply"></i></button>
            </div>
        </div>
    @endforeach




    <!-- CSS Styles -->
    <style>
        .comments-container {
            max-width: 800px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }

        .comments-container h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }

        .comment-box {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            position: relative;
        }

        .comment-box::before {
            content: '';
            position: absolute;
            left: 25px;
            top: 100%;
            height: 15px;
            width: 2px;
            background-color: #e0e0e0;
        }

        .comment-box:last-child::before {
            display: none;
        }

        .comment-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-info {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
        }

        .username {
            font-weight: bold;
            color: #4a90e2;
        }

        .badge {
            padding: 2px 8px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
        }

        .autor {
            background-color: #4a90e2;
            color: white;
        }

        .time {
            color: #999;
            font-size: 12px;
        }

        .comment-body {
            color: #666;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        .comment-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .like-btn,
        .reply-btn {
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            font-size: 16px;
            padding: 5px;
        }

        .like-btn:hover,
        .reply-btn:hover {
            color: #4a90e2;
        }

        .rating {
            color: #f5c518;
            /* màu vàng của sao */
            margin-bottom: 5px;
            font-size: 16px;
        }

        .comment-body textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
            margin-bottom: 10px;
            font-family: Arial, sans-serif;
        }

        .stars i {
            font-size: 2rem;
            color: #ccc;
            cursor: pointer;
        }

        .stars i.active {
            color: gold;
        }

        .submit-review-btn {
            background-color: #4a90e2;
            /* Màu xanh dương */
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            border-radius: 30px;
            /* Làm nút tròn hơn */
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-review-btn:hover {
            background-color: #357ab7;
            /* Màu xanh đậm hơn khi hover */
            transform: scale(1.05);
            /* Tăng kích thước nhẹ khi hover */
        }

        .submit-review-btn:focus {
            outline: none;
            /* Loại bỏ viền khi nhấn */
        }
    </style>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">