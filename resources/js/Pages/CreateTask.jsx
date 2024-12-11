import AlternativeButton from "./global/AlternativeButton";
import FormInput from "./global/FormInput";
import PrimaryButton from "./global/PrimaryButton";
import UserPicker from "./global/UserPicker";
import { useState } from "react";

export default function CreateTask() {
    const [selectedUser, setSelectedUser] = useState(null);
    const teamId = window.location.pathname.split("/")[3];
    const [taskName, setTaskName] = useState("");
    const [description, setDescription] = useState("");

    function createTask(){
        fetch(`/api/tasks/create`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authorization": `Bearer ${localStorage.getItem("token")}`,
            },
            body: JSON.stringify({
                title: taskName,
                body: description,
                team_id: parseInt(teamId),
                responsible_id: selectedUser,
            })
        })
        .then((response) => response.json())
        .then((json) => {
            if (json.status === "success") {
                window.location.href = `/team/${teamId}`;
            }
        })
    }

    return (
        <div className="container mx-auto my-auto">
            <h1 className="grid justify-center my-8">Crear tarea</h1>
                <div className="flex flex-col mx-4 mb-4 space-y-4">
                    <FormInput placeholder="Nombre de la tarea" type="text" setter={setTaskName}/>
                    <FormInput placeholder="Descripción"  type="text" setter={setDescription}/>
                    <h2 className="text-2xl py-5">Asignar tarea</h2>
                    <UserPicker selectedUser={selectedUser} setSelectedUser={setSelectedUser}/>
                    <PrimaryButton text="Crear tarea" action={() => createTask()}/>
                    <AlternativeButton text="Cancelar"/>
                </div>
        </div>
    )
}
