<?php

/**
 * A class to represent a User.
 * This class holds basic user information.
 */
class User {
    private $id;
    private $name;
    private $email;
    private $createdAt;

    /**
     * User constructor.
     *
     * @param int    $id
     * @param string $name
     * @param string $email
     */
    public function __construct(int $id, string $name, string $email) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->createdAt = new \DateTime();
    }

    /**
     * Get user ID.
     *
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Get user name.
     *
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Set user name.
     *
     * @param string $name
     */
    public function setName(string $name): void {
        $this->name = $name;
    }

    /**
     * Get user email.
     *
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * Set user email.
     *
     * @param string $email
     */
    public function setEmail(string $email): void {
        // In a real application, you would add validation here.
        $this->email = $email;
    }

    /**
     * Get creation timestamp.
     *
     * @return DateTime
     */
    public function getCreatedAt(): \DateTime {
        return $this->createdAt;
    }
}

/**
 * Manages users in a simulated database (an array).
 * Contains a bug in the deleteUserById method.
 */
class UserManager {
    private $users = [];
    private $nextId = 1;

    /**
     * Add a new user.
     *
     * @param string $name
     * @param string $email
     * @return User
     */
    public function addUser(string $name, string $email): User {
        $user = new User($this->nextId, $name, $email);
        $this->users[] = $user;
        $this->nextId++;
        echo "User '{$name}' added successfully.\n";
        return $user;
    }

    /**
     * Get a user by their ID.
     *
     * @param int $id
     * @return User|null
     */
    public function getUserById(int $id): ?User {
        foreach ($this->users as $user) {
            if ($user->getId() === $id) {
                return $user;
            }
        }
        return null;
    }

    /**
     * Deletes a user by their ID.
     * THIS METHOD CONTAINS A BUG.
     * It uses a numeric for loop after potentially unsetting elements,
     * which can lead to an "Undefined offset" notice if the array keys
     * are no longer contiguous.
     *
     * @param int $id
     * @return bool
     */
    public function deleteUserById(int $id): bool {
        $userFound = false;
        for ($i = 0; $i < count($this->users); $i++) {
            // Using a for loop like this is problematic if array keys change.
            if (isset($this->users[$i]) && $this->users[$i]->getId() === $id) {
                unset($this->users[$i]);
                $userFound = true;
                echo "Attempting to delete user with ID: {$id}.\n";
                // Do not break here to illustrate the bug if there were duplicates.
            }
        }
        
        if ($userFound) {
            echo "User with ID: {$id} has been deleted.\n";
            // The array is not re-indexed, so the keys are no longer sequential.
            // Any subsequent operation that relies on sequential numeric keys will fail.
        } else {
            echo "Could not find user with ID: {$id}.\n";
        }

        return $userFound;
    }

    /**
     * List all users.
     */
    public function listAllUsers(): void {
        echo "\n--- User List ---\n";
        if (empty($this->users)) {
            echo "No users in the system.\n";
        } else {
            // Using foreach is safe and avoids the bug.
            foreach ($this->users as $user) {
                echo "ID: {$user->getId()}, Name: {$user->getName()}, Email: {$user->getEmail()}\n";
            }
        }
        echo "-----------------\n\n";
    }
}

// --- Main execution ---

$userManager = new UserManager();

// Adding some users
$userManager->addUser('Alice', 'alice@example.com');
$userManager->addUser('Bob', 'bob@example.com');
$userManager->addUser('Charlie', 'charlie@example.com');

$userManager->listAllUsers();

// Deleting a user from the middle.
// This will create a gap in the array keys.
$userManager->deleteUserById(2); // Deleting Bob

$userManager->listAllUsers();

// Now, let's trigger the bug.
// We will try to delete another user. The loop in `deleteUserById`
// will now likely hit an undefined offset because the keys are 0 and 2, but the loop will check for 0, 1, 2.
echo "Now, let's try to delete another user, which will trigger the bug.\n";
$userManager->deleteUserById(3); // Deleting Charlie

$userManager->listAllUsers();

?>
