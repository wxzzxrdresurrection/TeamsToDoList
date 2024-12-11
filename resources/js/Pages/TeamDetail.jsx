import Navbar from "./global/Navbar"
import Settings from "./Settings"
import Tasks from "./Tasks"
import AllTasks from "./AllTasks"
import { useState, useEffect } from "react"
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome"
import { faArrowLeft } from "@fortawesome/free-solid-svg-icons"

export default function TeamTasks(){
    function createNewTask(){
        const teamId = window.location.pathname.split('/')[2]
        window.location.href = `/task/new/${teamId}`
    }

    const navigateToTeamList = () => {
        window.location.href = '/teams'
    }

    const [selectedview, setSelectedView] = useState(1)

    return (
        <div className="h-full">
            <div onClick={navigateToTeamList}>
                <FontAwesomeIcon icon={ faArrowLeft } className="text-white text-3xl mt-5 ml-5"/>
            </div>
            {selectedview === 1 && <Tasks />}
            {selectedview === 2 && <AllTasks />}
            {selectedview === 3 && <Settings />}

            <button className="fixed bottom-20 bg-zinc-700 rounded-full px-5 py-2 right-2"
            onClick={() => createNewTask()}>
                + Agregar tarea
            </button>
            <div className="fixed bottom-0 w-full">
                <Navbar setSelectedView={setSelectedView}/>
            </div>
        </div>
    )
}
