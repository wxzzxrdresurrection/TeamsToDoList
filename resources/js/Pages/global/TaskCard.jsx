import Checkbox from "./Checkbox";
import { useEffect, useState } from 'react';

export default function TaskCard({ task }) {
    const [completed, setCompleted] = useState(task.completed);

    const toggleCompleted = () => {
        setCompleted(!completed);
    };

    return (
        <div className="flex flex-col mx-4 mb-4">
            <div className="flex items-start space-x-3">
                <div className="mt-1">
                    <Checkbox completed={completed} onToggle={toggleCompleted}/>
                </div>
                <div className="flex flex-col w-full border-b border-zinc-700 pb-4">
                    <div className="w-full mb-2">
                        <span
                            className={
                                    completed
                                    ? "text-md text-wrap text-ellipsis line-through text-zinc-500"
                                    : "text-md text-wrap text-ellipsis"
                            }
                        >
                            {task.title}
                        </span>
                    </div>
                    <p className={"text-sm text-gray-400" }>{task.body}</p>
                </div>
            </div>
        </div>
    );
}
