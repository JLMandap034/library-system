# Installation Process
---
Step 1:
- **Clone repository**

Step 2:
- **Run *composer install***

Step 3:
- **Run *npm install***

Step 4:
- **Run *php artisan migrate db:seed*** (This is for the admin account)

Step 5:
- **Run *php artisan serve --port=3001*** (Port is optional, I was encountering an error with my localhost and Laragon)

Step 6:
- **Run *npm run dev***

# API Endpoint
---
```/api/books```

Sample Response:
```
{
    "data": [
        {
            "name": "Book 1",
            "author": "Author 1",
            "published_at": "January 01, 2020",
            "libraries": [
                "Library A",
                "Library B"
            ],
            "histories": [
                {
                    "borrowed_by": "Test",
                    "borrowed_at": "January 23, 2024 05:01:17 AM",
                    "returned_at": null
                },
                {
                    "borrowed_by": "Test",
                    "borrowed_at": "January 23, 2024 04:13:43 AM",
                    "returned_at": "January 23, 2024 04:21:46 AM"
                },
                {
                    "borrowed_by": "Test",
                    "borrowed_at": "January 23, 2024 04:13:20 AM",
                    "returned_at": "January 23, 2024 04:13:34 AM"
                }
            ]
        },
        {
            "name": "Book 2",
            "author": "Author 2",
            "published_at": "May 20, 1998",
            "libraries": [],
            "histories": []
        }
    ]
}
```
