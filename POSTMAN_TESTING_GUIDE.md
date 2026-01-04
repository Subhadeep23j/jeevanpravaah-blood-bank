# Testing Mobile Admin Login in Postman

## Step 1: Create a New Collection

1. Open **Postman**
2. Click **"Collections"** on the left sidebar
3. Click **"+"** to create a new collection
4. Name it: **"Mobile Admin API"**
5. Click **Create**

---

## Step 2: Create Variables (Optional but Recommended)

1. Click on your collection **"Mobile Admin API"**
2. Go to the **"Variables"** tab
3. Add these variables:

| Variable     | Initial Value           | Current Value                |
| ------------ | ----------------------- | ---------------------------- |
| `baseUrl`    | `http://localhost:8000` | `http://localhost:8000`      |
| `adminToken` | (leave empty)           | (will be filled after login) |

4. Click **Save**

---

## Step 3: Create Login Request

1. Click **"+"** to add a new request
2. Set **Method**: `POST`
3. Set **URL**: `{{baseUrl}}/api/v1/admin/login`
4. Go to **"Headers"** tab and add:

    - Key: `Content-Type`
    - Value: `application/json`

5. Go to **"Body"** tab
6. Select **"raw"** and **"JSON"**
7. Enter:

```json
{
    "email": "admin@example.com",
    "password": "your_admin_password"
}
```

8. Click **"Send"**

**Expected Response:**

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

---

## Step 4: Save Token from Login Response (Important!)

### Using Tests Tab to Auto-Save Token:

1. In the **Login** request, go to **"Tests"** tab
2. Click **"Set an environment variable"** template on the right
3. Add this code:

```javascript
var jsonData = pm.response.json();
pm.collectionVariables.set("adminToken", jsonData.data.token);
```

4. Save the request
5. Now when you click **"Send"**, the token will be automatically saved!

---

## Step 5: Create Profile Request (Using Token)

1. Click **"+"** to add a new request
2. Name it: **"Get Admin Profile"**
3. Set **Method**: `GET`
4. Set **URL**: `{{baseUrl}}/api/v1/admin/profile`
5. Go to **"Headers"** tab and add:

    - Key: `Authorization`
    - Value: `Bearer {{adminToken}}`
    - Key: `Content-Type`
    - Value: `application/json`

6. Click **"Send"**

**Expected Response:**

```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Admin Name",
        "email": "admin@example.com",
        "created_at": "2025-01-01T00:00:00.000000Z"
    }
}
```

---

## Step 6: Create Logout Request

1. Click **"+"** to add a new request
2. Name it: **"Admin Logout"**
3. Set **Method**: `POST`
4. Set **URL**: `{{baseUrl}}/api/v1/admin/logout`
5. Go to **"Headers"** tab and add:

    - Key: `Authorization`
    - Value: `Bearer {{adminToken}}`

6. Click **"Send"**

**Expected Response:**

```json
{
    "success": true,
    "message": "Logged out successfully"
}
```

---

## Complete Testing Workflow

### In Postman, execute in this order:

1. **Send Login Request**

    - Status should be: **200 OK**
    - Token will be automatically saved

2. **Send Get Profile Request**

    - Status should be: **200 OK**
    - Shows your admin details

3. **Send Logout Request**

    - Status should be: **200 OK**
    - Token is revoked

4. **Try Get Profile Again (after logout)**
    - Status should be: **401 Unauthorized**
    - Message: "Unauthenticated"

---

## Postman Settings

### Collection Variables Tab

Make sure to set these in your collection:

```
baseUrl = http://localhost:8000
adminToken = (auto-filled after login)
```

---

## Common Response Codes

| Code    | Meaning          | Example                            |
| ------- | ---------------- | ---------------------------------- |
| **200** | Success          | Login successful, token returned   |
| **401** | Unauthorized     | Wrong credentials or invalid token |
| **403** | Forbidden        | Not an admin                       |
| **422** | Validation Error | Missing required fields            |
| **500** | Server Error     | Check Laravel logs                 |

---

## Troubleshooting in Postman

### "Invalid email or password"

-   Check admin account exists
-   Verify email and password are correct
-   Create test admin if needed:
    ```bash
    php artisan tinker
    Admin::create(['name'=>'Admin','email'=>'admin@example.com','password'=>bcrypt('password123')]);
    ```

### "Unauthenticated" error

-   Make sure token is saved in `adminToken` variable
-   Check Authorization header format: `Bearer {token}`
-   Make sure to run Login request first

### Can't connect to localhost:8000

-   Start Laravel server: `php artisan serve`
-   Check port 8000 is not in use
-   Verify URL is correct

### Token Variable Not Working

-   Make sure you used `{{baseUrl}}` and `{{adminToken}}`
-   Go to Collections → Variables tab
-   Verify variables are set

---

## Export & Share

### To export your collection:

1. Right-click collection **"Mobile Admin API"**
2. Click **"Export"**
3. Choose **"Collection v2.1"**
4. Save as JSON file
5. Share with team!

---

## Quick Postman Setup (Copy-Paste)

### Login Request Body:

```json
{
    "email": "admin@example.com",
    "password": "password123"
}
```

### Profile Request Headers:

```
Authorization: Bearer {{adminToken}}
Content-Type: application/json
```

### Logout Request Headers:

```
Authorization: Bearer {{adminToken}}
```

---

## Visual Flow in Postman

```
┌─────────────────────────────────────┐
│  Mobile Admin API Collection        │
├─────────────────────────────────────┤
│                                     │
│  1️⃣  Login                          │
│     POST /api/v1/admin/login        │
│     Body: { email, password }       │
│     ✅ Returns: token               │
│                                     │
│  2️⃣  Get Profile                    │
│     GET /api/v1/admin/profile       │
│     Headers: Bearer {{adminToken}}  │
│     ✅ Returns: admin data          │
│                                     │
│  3️⃣  Logout                         │
│     POST /api/v1/admin/logout       │
│     Headers: Bearer {{adminToken}}  │
│     ✅ Revokes token                │
│                                     │
└─────────────────────────────────────┘
```

---

## Pre-Request Script (Optional)

If you want to log request details, add to any request's **"Pre-request Script"** tab:

```javascript
console.log("Sending request to: " + pm.request.url);
console.log("Token: " + pm.collectionVariables.get("adminToken"));
```

---

## Response Validation (Optional)

Add this to request **"Tests"** tab to validate responses:

```javascript
// Validate status code
pm.test("Status code is 200", function () {
    pm.response.to.have.status(200);
});

// Validate success field
pm.test("Response is successful", function () {
    var jsonData = pm.response.json();
    pm.expect(jsonData.success).to.be.true;
});

// Validate has token (for login)
pm.test("Response has token", function () {
    var jsonData = pm.response.json();
    pm.expect(jsonData.data.token).to.exist;
});
```

---

## Import Pre-Built Collection (Quick Start)

### Option 1: Manual Setup (5 minutes)

Follow steps 1-6 above

### Option 2: Use Postman Scripts

Create requests with proper headers and variables automatically

---

## Tips

✅ **Always save requests** - Click the Save button
✅ **Use variables** - Makes switching between environments easy
✅ **Check response body** - Click **"Pretty"** for formatted JSON
✅ **Test in order** - Login → Profile → Logout
✅ **Clear token** - After logout, manually clear `adminToken` variable to test 401

---

## Summary

| Request | Method | URL                     | Headers                         | Body                |
| ------- | ------ | ----------------------- | ------------------------------- | ------------------- |
| Login   | POST   | `/api/v1/admin/login`   | Content-Type: application/json  | { email, password } |
| Profile | GET    | `/api/v1/admin/profile` | Authorization: Bearer {{token}} | -                   |
| Logout  | POST   | `/api/v1/admin/logout`  | Authorization: Bearer {{token}} | -                   |

**Ready to test! 🚀**
