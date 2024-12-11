export default function TeamTasks({ tasks }) {
    return (
        <div className="container mx-auto my-auto">
            <div className="flex flex-col mx-4">
                <div className="flex flex-col">
                    {tasks.map((task) => (
                        <div className="border-b border-zinc-700 w-full py-3 hover:cursor-pointer"
                        key={task.id}>
                            <p className={
                                    task.is_completed
                                    ? "text-md text-wrap text-ellipsis line-through text-zinc-500"
                                    : "text-md text-wrap text-ellipsis"
                            }>
                                {task.title} - Asignada a: {task.responsible.username}
                            </p>
                            <p className="text-md text-zinc-400"> {task.body}</p>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
}
