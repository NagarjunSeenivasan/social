
document.getElementById('search-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    const query = document.getElementById('search').value;

    fetch('search_courses.php?query=' + encodeURIComponent(query))
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('course-container');
            container.innerHTML = ''; // Clear existing courses

            data.courses.forEach(course => {
                const alreadyEnrolled = course.alreadyEnrolled; // Assuming this info is provided

                const courseCard = `
                    <div class="course-card">
                        <img src="../assets/uploads/${course.course_image}" alt="course-image">
                        <h3>${course.course_name}</h3>
                        <p>${course.description}</p>
                        ${alreadyEnrolled ? 
                            '<p style="color: red;">You have already enrolled in this course.</p>' :
                            `<form method="POST" action="../assets/enroll.php">
                                <input type="hidden" name="course_id" value="${course.id}">
                                <button type="submit" class="enroll-btn">Enroll</button>
                            </form>`
                        }
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', courseCard);
            });
        })
        .catch(error => {
            console.error('Error fetching courses:', error);
        });
});
