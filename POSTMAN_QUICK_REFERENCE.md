# Postman Quick Reference Card - Mobile Admin API

## 3-Step Setup in Postman

### Step 1: Login Request

```
Method:   POST
URL:      http://localhost:8000/api/v1/admin/login
Headers:  Content-Type: application/json
Body:     {
            "email": "admin@example.com",
            "password": "password123"
          }
```

**Click Send** ✅

Copy the `token` from response

---

### Step 2: Get Profile Request

```
Method:   GET
URL:      http://localhost:8000/api/v1/admin/profile
Headers:  Authorization: Bearer PASTE_TOKEN_HERE
          Content-Type: application/json
```

**Click Send** ✅

---

### Step 3: Logout Request

```
Method:   POST
URL:      http://localhost:8000/api/v1/admin/logout
Headers:  Authorization: Bearer PASTE_TOKEN_HERE
```

**Click Send** ✅

---

## Copy-Paste Headers

### For GET Profile & POST Logout:

```
Authorization: Bearer 1|abc123xyz456def789ghi...
Content-Type: application/json
```

(Replace with actual token from login response)

---

## Copy-Paste Request Body (for Login):

```json
{
    "email": "admin@example.com",
    "password": "password123"
}
```

---

## Postman Collection Structure

```
Mobile Admin API
├── 1. Admin Login (POST)
│   └── Returns: { token, admin }
├── 2. Get Admin Profile (GET)
│   └── Returns: { admin data }
└── 3. Admin Logout (POST)
    └── Revokes: token
```

---

## Expected Responses

### Login Success ✅

```json
{
    "success": true,
    "message": "Logged in successfully",
    "data": {
        "token": "1|abc...",
        "admin": { "id": 1, "email": "admin@example.com" }
    }
}
```

### Profile Success ✅

```json
{
    "success": true,
    "data": { "id": 1, "email": "admin@example.com", "name": "Admin" }
}
```

### Logout Success ✅

```json
{
    "success": true,
    "message": "Logged out successfully"
}
```

### Errors ❌

```json
{ "success": false, "message": "Invalid email or password" }
```

---

## Status Codes

-   **200** = Success ✅
-   **401** = Wrong credentials or invalid token ❌
-   **422** = Missing fields ❌

---

## 60-Second Setup

1. Open Postman
2. Click **"New"** → **"Request"**
3. Change to **POST**
4. Paste: `http://localhost:8000/api/v1/admin/login`
5. Go to **Body** → select **raw** → paste:
    ```json
    { "email": "admin@example.com", "password": "password123" }
    ```
6. Click **Send** 🚀
7. Copy token from response
8. Create new **GET** request to `/api/v1/admin/profile`
9. Add header: `Authorization: Bearer {token}`
10. Click **Send** ✅

---

## No Token? Do This:

1. Check if **Login** returned `success: true`
2. Look for `"token"` in response body
3. Make sure you copied the **entire token** (long string)
4. Use format: `Bearer 1|abc...` (with space after Bearer)
5. Retry **Get Profile**

---

## Use Variables to Auto-Save Token (Advanced)

In **Login** request, go to **Tests** tab:

```javascript
pm.collectionVariables.set("adminToken", pm.response.json().data.token);
```

Then in headers, use: `Bearer {{adminToken}}`

---

## Postman Tips

✅ Use **"Pretty"** button to format JSON responses
✅ Copy the full **token** string (it's long!)
✅ Make sure **Content-Type** header is set
✅ Test in order: Login → Profile → Logout
✅ After logout, try Profile again (should get 401)

---

## Common Mistakes

❌ Wrong: `Authorization: {{adminToken}}`
✅ Right: `Authorization: Bearer {{adminToken}}`

❌ Wrong: `Authorization Bearer token123` (missing colon)
✅ Right: `Authorization: Bearer token123`

❌ Wrong: Empty password field
✅ Right: Fill all required fields in body

❌ Wrong: GET instead of POST for login
✅ Right: Use POST for login

---

## Still Not Working?

1. **Check admin exists**: `php artisan tinker` → `Admin::all()`
2. **Create admin if needed**:
    ```php
    Admin::create(['name'=>'Admin','email'=>'admin@example.com','password'=>bcrypt('password123')]);
    ```
3. **Laravel running**: `php artisan serve`
4. **Port correct**: http://localhost:8000
5. **Headers correct**: Content-Type and Authorization

---

## Full Request Examples

### Login (Copy entire section)

```
POST http://localhost:8000/api/v1/admin/login
Content-Type: application/json

{
  "email": "admin@example.com",
  "password": "password123"
}
```

### Get Profile (Copy entire section)

```
GET http://localhost:8000/api/v1/admin/profile
Authorization: Bearer 1|abc123xyz456def789ghi...
Content-Type: application/json
```

### Logout (Copy entire section)

```
POST http://localhost:8000/api/v1/admin/logout
Authorization: Bearer 1|abc123xyz456def789ghi...
```

---

**See [POSTMAN_TESTING_GUIDE.md](POSTMAN_TESTING_GUIDE.md) for detailed instructions** 📖
