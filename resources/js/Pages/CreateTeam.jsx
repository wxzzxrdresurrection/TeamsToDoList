import FormInput from "./global/FormInput"
import PrimaryButton from "./global/PrimaryButton"
import { useState } from "react";

export default function CreateTeam() {

    const [teamName, setTeamName] = useState('');
    const [teamDescription, setTeamDescription] = useState('');

    function createTeam(){
        fetch('/api/teams/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            body: JSON.stringify({
                name: teamName,
                description: teamDescription
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                window.location.href = '/teams'
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });

    }

    return(
        <div className="container mx-auto my-auto">
            <h1 className="grid justify-center my-8">Crear equipo</h1>
                <div className="flex flex-col mx-4 mb-4 space-y-4">
                    <FormInput placeholder="Nombre del grupo" type="text" setter={setTeamName}/>
                    <FormInput placeholder="Descripción del grupo" type="text" setter={setTeamDescription}/>
                    <PrimaryButton action={() => createTeam()} text="Crear equipo"/>
                </div>
        </div>
    )
}
