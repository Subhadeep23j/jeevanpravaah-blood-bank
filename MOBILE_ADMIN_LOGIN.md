# Mobile Admin Login API

## How to Use on Mobile (localhost)

### 1. Login and Get Token

**Request:**

```
POST http://localhost:8000/api/v1/admin/login
Content-Type: application/json

{
  "email": "admin@example.com",
  "password": "admin_password"
}
```

**Response (Success):**

```json
{
    "success": true,
    "message": "Logged in successfully",
    "data": {
        "admin": {
            "id": 1,
            "name": "Admin Name",
            "email": "admin@example.com",
            "created_at": "2025-01-01T00:00:00.000000Z"
        },
        "token": "1|abc123xyz456def789ghi..."
    }
}
```

**Response (Error):**

```json
{
    "success": false,
    "message": "Invalid email or password"
}
```

### 2. Store the Token

After login, save the token in your mobile app:

**React Native / Flutter:**

```javascript
// Store token in secure storage
const token = response.data.data.token;
await AsyncStorage.setItem("adminToken", token);
// or in Flutter: await secureStorage.write(key: 'adminToken', value: token);
```

### 3. Use Token for All Admin Requests

Include token in Authorization header:

```
GET http://localhost:8000/api/v1/admin/profile
Authorization: Bearer 1|abc123xyz456def789ghi...
Content-Type: application/json
```

**Response:**

```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Admin Name",
        "email": "admin@example.com"
    }
}
```

### 4. Logout (Optional)

```
POST http://localhost:8000/api/v1/admin/logout
Authorization: Bearer 1|abc123xyz456def789ghi...
```

Then clear the token from local storage.

---

## Quick Test with cURL

```bash
# Login
curl -X POST http://localhost:8000/api/v1/admin/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@example.com","password":"admin_password"}'

# Copy the token from response, then:
TOKEN="1|abc123..."

# Test profile endpoint
curl http://localhost:8000/api/v1/admin/profile \
  -H "Authorization: Bearer $TOKEN"

# Logout
curl -X POST http://localhost:8000/api/v1/admin/logout \
  -H "Authorization: Bearer $TOKEN"
```

---

## Available Endpoints

| Method | Endpoint                | Description           | Auth |
| ------ | ----------------------- | --------------------- | ---- |
| POST   | `/api/v1/admin/login`   | Login & get token     | No   |
| GET    | `/api/v1/admin/profile` | Get admin profile     | Yes  |
| POST   | `/api/v1/admin/logout`  | Logout & revoke token | Yes  |

---

## Important Notes

1. **Email/Password** - Use admin account credentials
2. **Token Storage** - Store securely (not in plain text)
3. **Authorization Header** - Format: `Bearer {token}` (with space)
4. **Content-Type** - Always use `application/json`
5. **HTTPS in Production** - Never send tokens over HTTP

---

## Troubleshooting

### "Invalid email or password"

-   Check admin account exists in database
-   Verify credentials are correct
-   Ensure it's an admin account, not a regular user

### "Unauthorized" on other endpoints

-   Make sure token is stored correctly
-   Check Authorization header format: `Bearer {token}`
-   Token may have been revoked - re-login

### CORS Error

-   Make sure you're using the correct API URL
-   Check Content-Type header is set
-   Verify localhost:8000 is correct
