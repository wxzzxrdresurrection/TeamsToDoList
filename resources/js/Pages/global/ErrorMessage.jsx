export default function ErrorMessage({message}) {
    return (
        <div hidden={message === ''}>
            <p className="text-red-500 text-sm ml-1">
                {message}
            </p>
        </div>
    );

}
