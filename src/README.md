# Dockerized CodeIgniter (MySQL)

This repository contains a simple Docker setup for the CodeIgniter app.

Services:

- web: PHP 7.4 + Apache serving the CodeIgniter app (port 8080)
- db: MySQL 5.7 (port 3306)
- phpmyadmin: PhpMyAdmin (port 8081)

Quick start:

1. Copy or create a `.env` file next to `docker-compose.yml` with values (optional):

```env
DB_NAME=ci_db
DB_USER=ci_user
DB_PASS=ci_pass
MYSQL_ROOT_PASSWORD=rootpass
```

2. Build and run:

```bash
docker compose up --build
```

3. Open the app at http://localhost:8080
   PhpMyAdmin at http://localhost:8081 (user: `root`, password from `MYSQL_ROOT_PASSWORD`)

Notes:

- The app is mounted into the container, so changes on the host are reflected immediately.
- Ensure `application/cache` and `application/logs` are writable by the webserver (the entrypoint will attempt to chown them).
  Fantastic work. You've built a fully functional CRUD application. Now, let's turn it into a real-world application by adding one of the most critical features: **User Authentication**.

Right now, your notes app is a free-for-all. Anyone who visits the site can see, edit, and delete all the notes. We're going to fix that by making sure users have to register and log in, and can only manage their own notes.

---

here

## Chapter 03: User Authentication

### Objective 🎯

Secure the application by implementing user registration, login, and logout. You will modify the notes functionality so that all notes belong to a user, and users can only interact with their own notes.

### Key Concepts

- **Sessions:** When a user logs in, the server needs a way to remember them as they move from page to page. The **CodeIgniter Session Library** stores small bits of data (like `user_id` and `username`) that persist for a user's entire visit.
- **Password Hashing:** We **never** store passwords as plain text in the database. A security breach would expose everyone's password. We use a strong one-way hashing algorithm (`password_hash()`) to store a secure representation of the password. When a user tries to log in, we hash their input and compare it to the stored hash (`password_verify()`).
- **Form Validation:** We'll use CodeIgniter's **Form Validation Library** to ensure that users submit valid data (e.g., the username isn't empty, passwords match).

---

### Task 1: Database & Model Updates

1.  **Create the `users` Table:** Run this SQL query in your database to create a table for user data.

    ```sql
    CREATE TABLE users (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ```

2.  **Update the `notes` Table:** We need to link each note to a user. Run this query to add a `user_id` column to your `notes` table.

    ```sql
    ALTER TABLE notes
    ADD user_id INT(11) UNSIGNED NOT NULL;
    ```

3.  **Create the User Model:** Create a new file at `application/models/User_model.php`. This will handle all user-related database logic.

    ```php
    <?php
    class User_model extends CI_Model {

        public function register($enc_password) {
            // User data array
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $enc_password
            );

            // Insert user
            return $this->db->insert('users', $data);
        }

        public function login($username, $password) {
            // Validate
            $this->db->where('username', $username);
            $query = $this->db->get('users');

            if($query->num_rows() == 1) {
                $result = $query->row_array();
                if (password_verify($password, $result['password'])) {
                    return $result['id']; // Return user_id on success
                } else {
                    return false; // Passwords don't match
                }
            } else {
                return false; // User not found
            }
        }
    }
    ```

---

### Task 2: Create the `Users` Controller

This new controller will handle the logic for registration, login, and logout.

1.  Create a new file at `application/controllers/Users.php`.

    ```php
    <?php
    class Users extends CI_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->model('user_model');
            $this->load->library('form_validation');
            $this->load->library('session');
            $this->load->helper('url');
            $this->load->helper('form');
        }

        public function register() {
            $data['title'] = 'Sign Up';

            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('users/register', $data);
            } else {
                // Encrypt password
                $enc_password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                $this->user_model->register($enc_password);

                // Set message
                $this->session->set_flashdata('user_registered', 'You are now registered and can log in');
                redirect('users/login');
            }
        }

        public function login() {
            $data['title'] = 'Sign In';

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('users/login', $data);
            } else {
                // Get username & password
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                // Login user
                $user_id = $this->user_model->login($username, $password);

                if ($user_id) {
                    // Create session
                    $user_data = array(
                        'user_id' => $user_id,
                        'username' => $username,
                        'logged_in' => true
                    );
                    $this->session->set_userdata($user_data);
                    $this->session->set_flashdata('user_loggedin', 'You are now logged in');
                    redirect(base_url());
                } else {
                    $this->session->set_flashdata('login_failed', 'Login is invalid');
                    redirect('users/login');
                }
            }
        }

        public function logout() {
            // Unset user data
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('username');

            $this->session->set_flashdata('user_loggedout', 'You are now logged out');
            redirect('users/login');
        }
    }
    ```

2.  **Create the Views:** Create a new folder `application/views/users/`.

    - Inside, create `register.php`:
      ```html
      <h1><?= $title; ?></h1>
      <?php echo validation_errors(); ?>
      <?php echo form_open('users/register'); ?>
          <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" placeholder="Username">
          </div>
          <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" placeholder="Password">
          </div>
          <div class="form-group">
              <label>Confirm Password</label>
              <input type="password" name="password2" placeholder="Confirm Password">
          </div>
          <button type="submit">Submit</button>
      </form>
      ```
    - And create `login.php`:
      ```html
      <h1><?= $title; ?></h1>
      <?php if($this->session->flashdata('login_failed')): ?>
          <p><?php echo $this->session->flashdata('login_failed'); ?></p>
      <?php endif; ?>
      <?php echo form_open('users/login'); ?>
          <div class="form-group">
              <input type="text" name="username" placeholder="Enter Username" required>
          </div>
          <div class="form-group">
              <input type="password" name="password" placeholder="Enter Password" required>
          </div>
          <button type="submit">Login</button>
      </form>
      ```

---

### Task 3: Secure the `Notes` Controller and Model

This is the most important step. We must ensure only logged-in users can access notes and that they can only access their own.

1.  **Modify `Notes` Controller:**

    - Add a check in the `__construct()` function to see if a user is logged in. If not, redirect them.
    - Update the `create` function to include the `user_id` from the session when creating a note.

    <!-- end list -->

    ```php
    // application/controllers/Notes.php
    public function __construct() {
        parent::__construct();
        // This check MUST come after the parent constructor
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        $this->load->model('note_model');
        $this->load->helper('url');
        $this->load->helper('form');
    }

    // In the create() function, modify the $note_data array
    public function create() {
        if ($this->input->post('title')) {
            $note_data = array(
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content'),
                'user_id' => $this->session->userdata('user_id') // ADD THIS LINE
            );
            $this->note_model->create_note($note_data);
            redirect(base_url());
        }
        // ... rest of the function is the same
    }
    ```

2.  **Modify `Note_model.php`:** Update every function to operate only on the notes belonging to the current user.

    ```php
    // application/models/Note_model.php

    // Modify get_notes()
    public function get_notes() {
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $query = $this->db->get('notes');
        return $query->result_array();
    }

    // get_note_by_id() also needs the user_id check for security
    public function get_note_by_id($id) {
        $query = $this->db->get_where('notes', array(
            'id' => $id,
            'user_id' => $this->session->userdata('user_id')
        ));
        return $query->row_array();
    }

    // delete_note() needs the check to prevent users from deleting others' notes
    public function delete_note($id) {
        $this->db->where('id', $id);
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->delete('notes');
        return true;
    }

    // update_note() also needs the check
    public function update_note($id, $data) {
        $this->db->where('id', $id);
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->update('notes', $data);
        return true;
    }

    // create_note() is fine as it is, because the user_id is passed in from the controller.
    ```

### Success Criteria ✅

- You can no longer access any note pages (e.g., the homepage) without being logged in. It should redirect you to `/users/login`.
- You can create a new user account via `/users/register`.
- You can log in with the new account. After logging in, you are redirected to the main notes page.
- A logged-in user can create, view, edit, and delete **only their own notes**.
- If you log in with a different user, you should see a completely different set of notes (or an empty list if they haven't created any).
- A user **cannot** edit or delete another user's note by guessing the URL (e.g., `/notes/edit/5` where note \#5 belongs to someone else). This should result in a 404 error because of our `get_note_by_id` model update.
- You can log out.

This is a big chapter. Take your time. Once this is done, your application will be significantly more powerful and secure. Let me know when you're ready for the next step.
