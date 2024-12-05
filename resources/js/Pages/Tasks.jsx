import TaskCard from "./global/TaskCard";

export default function Tasks() {

    const tasks = [
        {
            id: 1,
            title: 'Finish UI Design',
            description: 'Complete the design for the new task manager app',
            completed: true
        },
        {
            id: 2,
            title: 'Code the API',
            description: 'Write the code for the new task manager API',
            completed: true
        },
        {
            id: 3,
            title: 'Create the UI',
            description: 'Build the user interface for the new task manager app',
            completed: false
        },
        {
            id: 4,
            title: 'Write the documentation',
            description: 'Document the code for the new task manager app',
            completed: false
        },
        {
            id: 5,
            title: 'Test the app',
            description: 'Test the new task manager app for bugs and issues',
            completed: false
        }
    ];
    return (
        <div className="container mx-auto my-auto">
            <h1 className="grid justify-center my-8">Tareas</h1>
            <div className="flex flex-col mx-4 mb-3">
                <p className="text-sm">Mis tareas</p>
            </div>
            {tasks.map(task => ( <TaskCard key={task.id} task={task} />))}
        </div>
    );
}
