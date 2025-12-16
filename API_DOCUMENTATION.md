# JeevanPravaah API Documentation

## Base URL

-   **Development:** `http://localhost:8000/api/v1`
-   **Production:** `https://your-domain.com/api/v1`

## Rate Limiting

-   **60 requests per minute** per IP address

---

## Public Endpoints (No Authentication Required)

### 1. Get All Approved Donors

```
GET /api/v1/donors
```

**Response:**

```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "first_name": "John",
            "last_name": "Doe",
            "blood_group": "A+",
            "city": "Mumbai",
            "state": "Maharashtra",
            "availability": ["Monday", "Wednesday"]
        }
    ],
    "count": 1
}
```

---

### 2. Search Donors

```
GET /api/v1/donors/search
```

**Query Parameters:**
| Parameter | Type | Description |
|-----------|------|-------------|
| blood_group | string | Filter by blood group (e.g., A+, B-, O+, AB+) |
| city | string | Filter by city name |
| state | string | Filter by state name |

**Example:**

```
GET /api/v1/donors/search?blood_group=A+&city=Mumbai
```

---

### 3. Get Blood Group Statistics

```
GET /api/v1/statistics
```

**Response:**

```json
{
    "success": true,
    "data": {
        "by_blood_group": [
            { "blood_group": "A+", "count": 15 },
            { "blood_group": "B+", "count": 12 },
            { "blood_group": "O+", "count": 20 }
        ],
        "total_donors": 47
    }
}
```

---

## Protected Endpoints (Authentication Required)

> **Note:** These endpoints require a Bearer token in the Authorization header.
>
> ```
> Authorization: Bearer YOUR_TOKEN_HERE
> ```

### 4. Get Current User

```
GET /api/v1/user
```

### 5. Get User's Donation History

```
GET /api/v1/user/donations
```

### 6. Register as Donor

```
POST /api/v1/donors/register
```

**Request Body:**

```json
{
    "first_name": "John",
    "last_name": "Doe",
    "email": "john@example.com",
    "phone": "9876543210",
    "date_of_birth": "1990-05-15",
    "gender": "male",
    "blood_group": "A+",
    "weight": 70,
    "height": 175,
    "address": "123 Main Street",
    "city": "Mumbai",
    "state": "Maharashtra",
    "pincode": "400001",
    "availability": ["Monday", "Wednesday", "Friday"],
    "travel_distance": 10,
    "medical_conditions": null,
    "consent_medical": true,
    "consent_contact": true,
    "consent_privacy": true
}
```

---

## Error Responses

### 404 Not Found

```json
{
    "success": false,
    "message": "Resource not found"
}
```

### 422 Validation Error

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": ["The email field is required."]
    }
}
```

### 429 Too Many Requests

```json
{
    "message": "Too Many Attempts."
}
```

---

## Blood Group Values

Valid blood group values: `A+`, `A-`, `B+`, `B-`, `AB+`, `AB-`, `O+`, `O-`
