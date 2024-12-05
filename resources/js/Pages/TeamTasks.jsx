import Navbar from "./global/Navbar"
import Tasks from "./Tasks"

export default function TeamTasks(){
    return (
        <div className="h-full">
            <div className="flex-grow">
                <Tasks />
            </div>
            <div className="fixed bottom-0 w-full">
                <Navbar />
            </div>
        </div>
    )
}
