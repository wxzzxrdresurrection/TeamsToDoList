import Navbar from "./global/Navbar"
import Tasks from "./Tasks"

export default function TeamTasks(){
    function createNewTask(){
        const teamId = window.location.pathname.split('/')[2]
        console.log(teamId)
        window.location.href = `/task/new/${teamId}`
    }

    return (
        <div className="h-full">
            <div className="flex-grow">
                <Tasks />
            </div>

            <button className="fixed bottom-20 bg-zinc-700 rounded-full px-5 py-2 right-2"
            onClick={() => createNewTask()}>
                + Agregar tarea
            </button>
            {/* <div className="fixed bottom-0 w-full">
                <Navbar />
            </div> */}
        </div>
    )
}
