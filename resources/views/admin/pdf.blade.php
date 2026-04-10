<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ratings List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .rating-card {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .user-photo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        .rating-stars {
            margin-top: 5px;
            color: #f5a623; /* Star color */
        }
        .star {
            font-size: 20px;
            margin-right: 3px;
        }
        .star.filled {
            color: gold; /* Highlight filled stars in gold */
        }
        h3 {
            margin-top: 0;
        }
        p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
<h1>Ratings and Reviews</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Customer Name</th>
                <th>Rating</th>
                <th>Review</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ratings as $rating)
                <tr>
                    <td>{{ $rating->product_name }}</td>
                    <td>{{ $rating->customer_name }}</td>
                    <td>{{ $rating->rating }}</td>
                    <td>{{ $rating->review }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
