# InstantPay Task

# First Setup Project

# Any error or issues Apis check in Postman then Ran Command php artisan optimize.

# Authentication Mechanism:
#
# 1. Signup/Login: User creates an account or logs in using their credentials.
# {
#    "name": "User",
#    "email": "user@example.com",
#   "password": "12345678",
# }

#
# 2. When login then access_token Generation: On successful login, a token is generated for the user.
# {
#    "email": "user@example.com",
#    "password": "12345678",
# }
#
# 3. Protected API Access: The token is used to access the protected routes like users, boards, tasks which are guarded by the auth:sanctum middleware
#
#
