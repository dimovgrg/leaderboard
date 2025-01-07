### **Assignment: Create a Lap Time Leadership Board**

#### **Objective:**
Develop a basic lap time tracking system for a car racing leaderboard. The system will store racers' best lap times and display rankings based on their performance. Focus on PHP 8 features and MySQL for the functionality.

---

### **Requirements:**

1. **Database Structure**:
    - Create a `racers` table with the following fields:
        - `id` (Primary Key, Auto Increment)
        - `name` (VARCHAR, 100)
        - `email` (VARCHAR, 255, unique)
    - Create a `lap_times` table with the following fields:
        - `id` (Primary Key, Auto Increment)
        - `racer_id` (Foreign Key referencing `racers.id`)
        - `lap_time` (FLOAT, representing the lap time in seconds)
        - `date` (DATETIME, recording when the lap time was achieved)

2. **Functionality**:
    - **Add Racer**:
        - Create a script to add new racers. Validate that the email is unique and properly formatted.
    - **Record Lap Time**:
        - Create a script to add a lap time for a racer. Include validation to ensure the racer exists.
    - **Best Lap Times**:
        - Create a script to retrieve and display the top 10 racers based on their best lap times (lowest lap time).
    - **Search Feature**:
        - Allow searching for a racer by name or email to display their best lap time and rank on the leaderboard.

3. **PHP 8-Specific Features**:
    - Use **named arguments** for function calls.
    - Use **typed properties** in classes to define the data structure.
    - Implement **nullsafe operators** to handle nullable values.
    - Use **match expressions** to categorize lap times (e.g., excellent, good, average).
    - Include **arrow functions** for concise operations.

4. **Error Handling**:
    - Handle SQL errors gracefully using try-catch blocks.
    - Validate all user inputs to prevent SQL injection and XSS.

5. **Additional Features**:
    - Display a racer’s history of all recorded lap times.
    - Allow deletion of a racer and their lap times.
    - Reset a racer's lap times.

6. **Optional**:
    - Create a CLI script to populate the database with dummy racers and lap times.
    - Allow filtering the leaderboard by a specific date range.
    - Use `PDO` with prepared statements for secure database interactions.

---

### **Example Flow**:

1. Add new racers to the system.
2. Record lap times for racers.
3. Display the top 10 racers on the leaderboard based on their best lap times:
   ```
   Rank | Name      | Best Lap Time (seconds)
   1    | Alice     | 62.5
   2    | Bob       | 63.0
   3    | Charlie   | 63.2
   ```
4. Search for a specific racer (e.g., "Bob") to see:
   ```
   Name: Bob
   Rank: 2
   Best Lap Time: 63.0 seconds
   Lap Time History:
   - 64.1 seconds (2025-01-01 10:15:30)
   - 63.0 seconds (2025-01-02 11:20:45)
   ```

---

### **Deliverables**:
1. SQL file for the database schema.
2. PHP scripts for the specified functionality.
3. A brief README explaining how to set up and use the project.