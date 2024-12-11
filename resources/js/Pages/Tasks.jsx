import TaskCard from "./global/TaskCard";
import { useEffect, useState } from "react";

export default function Tasks() {
    const [tasks, setTasks] = useState([]);

    useEffect(() => {
        const url = window.location.pathname;
        const teamId = url.split("/")[2];
        getMyTasks(teamId);
    }, []);


    function getMyTasks(teamId) {
        fetch(`/api/tasks/${teamId}/user`,
            {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    setTasks(data.data);
                }
            })
            .catch(error => {
                console.error('There was an error!', error);
            });
    }

    return (
        <div className="container mx-auto my-auto">
            <h1 className="grid justify-center mb-8">Tareas</h1>
            <div className="flex flex-col mx-4 mb-3">
                <p className="text-sm">Mis tareas</p>
            </div>
            {tasks.map(task => ( <TaskCard key={task.id} task={task} />))}
        </div>
    );
}
