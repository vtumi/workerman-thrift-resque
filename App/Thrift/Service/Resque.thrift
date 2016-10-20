namespace php App.Thrift.Service.Resque

struct Request {
    1: string queue,
    2: optional string job,
    3: optional map<string, string> params,
    4: optional bool trackStatus = false,
    5: optional string id,
    6: optional list<string> jobs
}

exception InvalidValueException {
    1: i32 error_code,
    2: string error_msg
}

service Resque
{
    string enqueue(1:Request request) throws (1: InvalidValueException e);

    bool dequeue(1:Request request) throws (1: InvalidValueException e);

    i32 track(1:string id) throws (1: InvalidValueException e);
}
