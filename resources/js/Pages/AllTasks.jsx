import UserFilter from "./global/UserFilter";
import TeamTasks from "./global/TeamTasks";
import { useEffect, useState } from "react";

export default function AllTasks() {
    const [users, setUsers] = useState([]);
    const [tasks, setTasks] = useState([]);
    const [selectedUser, setSelectedUser] = useState(null);

    function getTasks(id) {
        fetch(`/api/tasks/team/all/${id}`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                Authorization: "Bearer " + localStorage.getItem("token"),
            },
        })
            .then((response) => response.json())
            .then((data) => {
                setTasks(data.data);
            });
    }

    function getTeamUsers(id) {
        fetch(`/api/teams/users/${id}`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                Authorization: "Bearer " + localStorage.getItem("token"),
            },
        })
            .then((response) => response.json())
            .then((data) => {
                setUsers(data.data);
            });
    }

    function getTasksByUser(userId) {
        fetch(`/api/tasks/user/all/1/${userId}`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                Authorization: "Bearer " + localStorage.getItem("token"),
            },
        })
            .then((response) => response.json())
            .then((data) => {
                setTasks(data.data);
            });
    }

    useEffect(() => {
        const id = window.location.pathname.split("/")[2];
        selectedUser ? getTasksByUser(selectedUser.id) : getTasks(id);
        getTeamUsers(id);
    }, [selectedUser]);

    return (
        <div className="container mx-auto my-auto">
            <h1 className="grid justify-center my-8">Todas las tareas</h1>
            <div className="w-full mb-2">
                <UserFilter users={users} selectedUser={selectedUser} setSelectedUser={setSelectedUser}/>
            </div>
            <TeamTasks tasks={tasks} />
        </div>
    );
}
